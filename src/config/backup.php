<?php
/**
 * Script de sauvegarde automatique de base de données MySQL
 * Exporte la BD, compresse en ZIP, vérifie la connexion et envoie par email
 */

// Configuration
const DB_HOST = 'localhost';
const DB_USER = 'root';
const DB_PASS = 'root';
const DB_NAME = 'beauty';

const BACKUP_DIR = __DIR__ . '/backups/';
const EMAIL_TO = 'ngahemeniw@gmail.com';
const EMAIL_FROM = 'ngahemeniw@gmail.com';
const MAX_BACKUP_DAYS = 30; // Garder les sauvegardes de 30 jours

// Créer le dossier de sauvegarde s'il n'existe pas
if (!file_exists(BACKUP_DIR)) {
    mkdir(BACKUP_DIR, 0755, true);
}

/**
 * Exporte la base de données en fichier SQL
 */
function exportDatabase() {
    $filename = 'backup_' . DB_NAME . '_' . date('Y-m-d_H-i-s') . '.sql';
    $filepath = BACKUP_DIR . $filename;

    // Commande mysqldump
    $command = sprintf(
        'mysqldump --user=%s --password=%s --host=%s %s > %s 2>&1',
        escapeshellarg(DB_USER),
        escapeshellarg(DB_PASS),
        escapeshellarg(DB_HOST),
        escapeshellarg(DB_NAME),
        escapeshellarg($filepath)
    );

    exec($command, $output, $return);

    if ($return !== 0 || !file_exists($filepath) || filesize($filepath) == 0) {
        logMessage("Erreur lors de l'export de la base de données");
        return false;
    }

    logMessage("Export réussi : $filename");
    return $filepath;
}

/**
 * Compresse le fichier SQL en ZIP
 */
function compressBackup($sqlFile) {
    $zipFile = str_replace('.sql', '.zip', $sqlFile);

    $zip = new ZipArchive();
    if ($zip->open($zipFile, ZipArchive::CREATE) === TRUE) {
        $zip->addFile($sqlFile, basename($sqlFile));
        $zip->close();

        // Supprimer le fichier SQL non compressé
        unlink($sqlFile);

        logMessage("Compression réussie : " . basename($zipFile));
        return $zipFile;
    }

    logMessage("Erreur lors de la compression");
    return false;
}

/**
 * Vérifie si la connexion internet est stable
 */
function isInternetStable(): bool
{
    $hosts = [
        'www.google.com',
        'www.cloudflare.com',
        '8.8.8.8'
    ];

    $successCount = 0;

    foreach ($hosts as $host) {
        $connected = @fsockopen($host, 80, $errno, $errstr, 5);
        if ($connected) {
            fclose($connected);
            $successCount++;
        }
    }

    // Connexion stable si au moins 2 tests sur 3 réussissent
    return $successCount >= 2;
}

/**
 * Envoie le fichier de sauvegarde par email
 */
function sendBackupEmail($zipFile): bool
{
    if (!file_exists($zipFile)) {
        logMessage("Fichier introuvable : $zipFile");
        return false;
    }

    $filename = basename($zipFile);
    $filesize = round(filesize($zipFile) / 1024 / 1024, 2);

    // Vérifier la taille du fichier (limite email généralement 25MB)
    if ($filesize > 25) {
        logMessage("Fichier trop volumineux pour l'email : {$filesize}MB");
        return false;
    }

    // Lire le fichier
    $content = file_get_contents($zipFile);
    $content = chunk_split(base64_encode($content));

    // Générer un boundary unique
    $boundary = md5(time());

    // En-têtes
    $headers = "From: " . EMAIL_FROM . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: multipart/mixed; boundary=\"{$boundary}\"\r\n";

    // Message
    $subject = "Sauvegarde base de données - " . date('d/m/Y H:i');

    $message = "--{$boundary}\r\n";
    $message .= "Content-Type: text/plain; charset=UTF-8\r\n";
    $message .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $message .= "Sauvegarde automatique de la base de données " . DB_NAME . "\n";
    $message .= "Date : " . date('d/m/Y à H:i:s') . "\n";
    $message .= "Taille du fichier : {$filesize} MB\n\n";
    $message .= "Fichier en pièce jointe.\r\n\r\n";

    // Pièce jointe
    $message .= "--{$boundary}\r\n";
    $message .= "Content-Type: application/zip; name=\"{$filename}\"\r\n";
    $message .= "Content-Transfer-Encoding: base64\r\n";
    $message .= "Content-Disposition: attachment; filename=\"{$filename}\"\r\n\r\n";
    $message .= $content . "\r\n";
    $message .= "--{$boundary}--";

    if (mail(EMAIL_TO, $subject, $message, $headers)) {
        logMessage("Email envoyé avec succès à " . EMAIL_TO);
        return true;
    }

    logMessage("Échec de l'envoi de l'email");
    return false;
}

/**
 * Nettoie les anciennes sauvegardes
 */
function cleanOldBackups() {
    $files = glob(BACKUP_DIR . 'backup_*.zip');
    $now = time();
    $deleted = 0;

    foreach ($files as $file) {
        if (is_file($file)) {
            if ($now - filemtime($file) >= 60 * 60 * 24 * MAX_BACKUP_DAYS) {
                unlink($file);
                $deleted++;
            }
        }
    }

    if ($deleted > 0) {
        logMessage("$deleted anciennes sauvegardes supprimées");
    }
}

/**
 * Enregistre les messages dans un fichier log
 */
function logMessage($message) {
    $logFile = BACKUP_DIR . 'backup.log';
    $timestamp = date('Y-m-d H:i:s');
    file_put_contents($logFile, "[$timestamp] $message\n", FILE_APPEND);
    echo "[$timestamp] $message\n";
}

/**
 * Récupère les sauvegardes en attente d'envoi
 */
function getPendingBackups() {
    $statusFile = BACKUP_DIR . 'pending_backups.json';

    if (!file_exists($statusFile)) {
        return [];
    }

    $data = json_decode(file_get_contents($statusFile), true);
    return $data ?: [];
}

/**
 * Ajoute une sauvegarde à la liste d'attente
 */
function addPendingBackup($zipFile) {
    $statusFile = BACKUP_DIR . 'pending_backups.json';
    $pending = getPendingBackups();
    $pending[] = $zipFile;
    file_put_contents($statusFile, json_stringify($pending));
}

/**
 * Supprime une sauvegarde de la liste d'attente
 */
function removePendingBackup($zipFile) {
    $statusFile = BACKUP_DIR . 'pending_backups.json';
    $pending = getPendingBackups();
    $pending = array_filter($pending, function($file) use ($zipFile) {
        return $file !== $zipFile;
    });
    file_put_contents($statusFile, json_encode(array_values($pending)));
}

// ========== SCRIPT PRINCIPAL ==========

logMessage("=== Démarrage du script de sauvegarde ===");

// 1. Créer une nouvelle sauvegarde
$sqlFile = exportDatabase();
if ($sqlFile) {
    $zipFile = compressBackup($sqlFile);
    if ($zipFile) {
        addPendingBackup($zipFile);
    }
}

// 2. Vérifier la connexion internet
if (isInternetStable()) {
    logMessage("Connexion internet stable détectée");

    // 3. Envoyer toutes les sauvegardes en attente
    $pendingBackups = getPendingBackups();

    if (empty($pendingBackups)) {
        logMessage("Aucune sauvegarde en attente d'envoi");
    } else {
        logMessage(count($pendingBackups) . " sauvegarde(s) en attente");

        foreach ($pendingBackups as $backup) {
            if (file_exists($backup)) {
                if (sendBackupEmail($backup)) {
                    removePendingBackup($backup);
                }
            } else {
                removePendingBackup($backup);
                logMessage("Fichier supprimé de la liste (inexistant) : $backup");
            }
        }
    }
} else {
    logMessage("Connexion internet instable - envoi reporté");
}

// 4. Nettoyer les anciennes sauvegardes
cleanOldBackups();

logMessage("=== Script terminé ===\n");

