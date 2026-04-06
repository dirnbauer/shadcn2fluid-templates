#!/usr/bin/env php
<?php
/**
 * Generate translation files for all content elements.
 *
 * 1. Creates shared labels.xlf + de/fr/es/it translations
 * 2. Creates per-element language/labels.xlf + translations
 * 3. Updates config.yaml to use LLL: references for shared labels
 *
 * Usage: php scripts/generate-translations.php (requires Composer autoload / symfony/yaml)
 */

declare(strict_types=1);

require dirname(__DIR__) . '/vendor/autoload.php';

use Symfony\Component\Yaml\Yaml;

$basePath = dirname(__DIR__);
$contentElementsPath = $basePath . '/ContentBlocks/ContentElements';
$sharedLangPath = $basePath . '/Resources/Private/Language';

// ──────────────────────────────────────────────────────────────
// Shared labels: labels that appear in many content elements
// ──────────────────────────────────────────────────────────────
$sharedLabels = [
    // Field labels (key => [en, de, fr, es, it])
    'heading' => ['Heading', 'Überschrift', 'Titre', 'Encabezado', 'Intestazione'],
    'description' => ['Description', 'Beschreibung', 'Description', 'Descripción', 'Descrizione'],
    'subheadline' => ['Subheadline', 'Unterüberschrift', 'Sous-titre', 'Subtítulo', 'Sottotitolo'],
    'eyebrow' => ['Eyebrow', 'Dachzeile', 'Surtitre', 'Ceja', 'Sopratitolo'],
    'button_text' => ['Button Text', 'Button-Text', 'Texte du bouton', 'Texto del botón', 'Testo pulsante'],
    'button_link' => ['Button Link', 'Button-Link', 'Lien du bouton', 'Enlace del botón', 'Link pulsante'],
    'label' => ['Label', 'Bezeichnung', 'Libellé', 'Etiqueta', 'Etichetta'],
    'link' => ['Link', 'Link', 'Lien', 'Enlace', 'Link'],
    'optional_link' => ['Optional Link', 'Optionaler Link', 'Lien optionnel', 'Enlace opcional', 'Link opzionale'],
    'link_text' => ['Link Text', 'Linktext', 'Texte du lien', 'Texto del enlace', 'Testo link'],
    'title' => ['Title', 'Titel', 'Titre', 'Título', 'Titolo'],
    'image' => ['Image', 'Bild', 'Image', 'Imagen', 'Immagine'],
    'name' => ['Name', 'Name', 'Nom', 'Nombre', 'Nome'],
    'content' => ['Content', 'Inhalt', 'Contenu', 'Contenido', 'Contenuto'],
    'text' => ['Text', 'Text', 'Texte', 'Texto', 'Testo'],
    'style' => ['Style', 'Stil', 'Style', 'Estilo', 'Stile'],
    'layout' => ['Layout', 'Layout', 'Disposition', 'Diseño', 'Layout'],
    'columns' => ['Columns', 'Spalten', 'Colonnes', 'Columnas', 'Colonne'],
    'alignment' => ['Alignment', 'Ausrichtung', 'Alignement', 'Alineación', 'Allineamento'],
    'text_alignment' => ['Text Alignment', 'Textausrichtung', 'Alignement du texte', 'Alineación del texto', 'Allineamento testo'],
    'primary_button_text' => ['Primary Button Text', 'Primärer Button-Text', 'Texte bouton principal', 'Texto botón primario', 'Testo pulsante primario'],
    'primary_button_link' => ['Primary Button Link', 'Primärer Button-Link', 'Lien bouton principal', 'Enlace botón primario', 'Link pulsante primario'],
    'secondary_button_text' => ['Secondary Button Text', 'Sekundärer Button-Text', 'Texte bouton secondaire', 'Texto botón secundario', 'Testo pulsante secondario'],
    'secondary_button_link' => ['Secondary Button Link', 'Sekundärer Button-Link', 'Lien bouton secondaire', 'Enlace botón secundario', 'Link pulsante secondario'],
    'badge_text' => ['Badge Text', 'Badge-Text', 'Texte du badge', 'Texto de insignia', 'Testo badge'],
    'background_image' => ['Background Image', 'Hintergrundbild', 'Image d\'arrière-plan', 'Imagen de fondo', 'Immagine di sfondo'],
    'author_name' => ['Author Name', 'Autorenname', 'Nom de l\'auteur', 'Nombre del autor', 'Nome autore'],
    'author_role' => ['Author Role', 'Autorenrolle', 'Rôle de l\'auteur', 'Rol del autor', 'Ruolo autore'],
    'author_title' => ['Author Title', 'Autorentitel', 'Titre de l\'auteur', 'Título del autor', 'Titolo autore'],
    'author_photo' => ['Author Photo', 'Autorenfoto', 'Photo de l\'auteur', 'Foto del autor', 'Foto autore'],
    'copyright_text' => ['Copyright Text', 'Copyright-Text', 'Texte de copyright', 'Texto de copyright', 'Testo copyright'],
    'price' => ['Price', 'Preis', 'Prix', 'Precio', 'Prezzo'],
    'rating' => ['Rating', 'Bewertung', 'Évaluation', 'Valoración', 'Valutazione'],
    'brand' => ['Brand', 'Marke', 'Marque', 'Marca', 'Marchio'],
    'brand_name' => ['Brand Name', 'Markenname', 'Nom de marque', 'Nombre de marca', 'Nome marchio'],
    'brand_link' => ['Brand Link', 'Marken-Link', 'Lien de marque', 'Enlace de marca', 'Link marchio'],
    'form_action' => ['Form Action', 'Formular-URL', 'Action du formulaire', 'Acción del formulario', 'Azione modulo'],
    'features' => ['Features', 'Funktionen', 'Fonctionnalités', 'Características', 'Funzionalità'],
    'features_one_per_line' => ['Features (one per line)', 'Funktionen (eine pro Zeile)', 'Fonctionnalités (une par ligne)', 'Características (una por línea)', 'Funzionalità (una per riga)'],
    'portrait' => ['Portrait', 'Porträt', 'Portrait', 'Retrato', 'Ritratto'],
    'value' => ['Value', 'Wert', 'Valeur', 'Valor', 'Valore'],
    'role' => ['Role', 'Rolle', 'Rôle', 'Rol', 'Ruolo'],
    'logo' => ['Logo', 'Logo', 'Logo', 'Logo', 'Logo'],
    'short_description' => ['Short Description', 'Kurzbeschreibung', 'Description courte', 'Descripción breve', 'Descrizione breve'],
    'company_name' => ['Company Name', 'Firmenname', 'Nom de l\'entreprise', 'Nombre de la empresa', 'Nome azienda'],
    'icon_emoji' => ['Icon Emoji or Symbol', 'Icon-Emoji oder Symbol', 'Icône emoji ou symbole', 'Emoji o símbolo de icono', 'Emoji o simbolo icona'],
    'navigation_items' => ['Navigation Items', 'Navigationselemente', 'Éléments de navigation', 'Elementos de navegación', 'Elementi di navigazione'],
    'links' => ['Links', 'Links', 'Liens', 'Enlaces', 'Link'],
    'links_one_per_line' => ['Links (one per line)', 'Links (einer pro Zeile)', 'Liens (un par ligne)', 'Enlaces (uno por línea)', 'Link (uno per riga)'],
    'items' => ['Items', 'Einträge', 'Éléments', 'Elementos', 'Elementi'],
    'plans' => ['Plans', 'Tarife', 'Plans', 'Planes', 'Piani'],
    'chart_data_json' => ['Chart Data (JSON)', 'Diagrammdaten (JSON)', 'Données du graphique (JSON)', 'Datos del gráfico (JSON)', 'Dati grafico (JSON)'],
    'show_more_link' => ['Show More Link', 'Mehr-anzeigen-Link', 'Lien voir plus', 'Enlace ver más', 'Link mostra altro'],
    'placeholder_text' => ['Placeholder Text', 'Platzhaltertext', 'Texte de remplacement', 'Texto de marcador', 'Testo segnaposto'],
    'submit_text' => ['Submit Text', 'Absenden-Text', 'Texte de soumission', 'Texto de envío', 'Testo invio'],
    'consent_text' => ['Consent Text', 'Einwilligungstext', 'Texte de consentement', 'Texto de consentimiento', 'Testo consenso'],
    'success_message' => ['Success Message', 'Erfolgsmeldung', 'Message de succès', 'Mensaje de éxito', 'Messaggio di successo'],
    'currency' => ['Currency', 'Währung', 'Devise', 'Moneda', 'Valuta'],
    'period' => ['Period', 'Zeitraum', 'Période', 'Período', 'Periodo'],
    'highlighted' => ['Highlighted', 'Hervorgehoben', 'Mis en avant', 'Destacado', 'In evidenza'],
    'product_image' => ['Product Image', 'Produktbild', 'Image du produit', 'Imagen del producto', 'Immagine prodotto'],
    'column_content' => ['Column Content', 'Spalteninhalt', 'Contenu de colonne', 'Contenido de columna', 'Contenuto colonna'],
    'target_date' => ['Target Date', 'Zieldatum', 'Date cible', 'Fecha objetivo', 'Data obiettivo'],
    'show_labels' => ['Show Labels', 'Beschriftungen anzeigen', 'Afficher les étiquettes', 'Mostrar etiquetas', 'Mostra etichette'],
    'show_grid' => ['Show Grid', 'Raster anzeigen', 'Afficher la grille', 'Mostrar cuadrícula', 'Mostra griglia'],
    'card_style' => ['Card Style', 'Kartenstil', 'Style de carte', 'Estilo de tarjeta', 'Stile scheda'],
    'layout_variant' => ['Layout Variant', 'Layout-Variante', 'Variante de disposition', 'Variante de diseño', 'Variante layout'],
    'color' => ['Color', 'Farbe', 'Couleur', 'Color', 'Colore'],
    'trend' => ['Trend', 'Trend', 'Tendance', 'Tendencia', 'Tendenza'],
    'image_position' => ['Image Position', 'Bildposition', 'Position de l\'image', 'Posición de imagen', 'Posizione immagine'],
    'position' => ['Position', 'Position', 'Position', 'Posición', 'Posizione'],

    // Select item values
    'item.left' => ['Left', 'Links', 'Gauche', 'Izquierda', 'Sinistra'],
    'item.center' => ['Center', 'Zentriert', 'Centré', 'Centrado', 'Centrato'],
    'item.right' => ['Right', 'Rechts', 'Droite', 'Derecha', 'Destra'],
    'item.default' => ['Default', 'Standard', 'Par défaut', 'Predeterminado', 'Predefinito'],
    'item.2_columns' => ['2 Columns', '2 Spalten', '2 colonnes', '2 columnas', '2 colonne'],
    'item.3_columns' => ['3 Columns', '3 Spalten', '3 colonnes', '3 columnas', '3 colonne'],
    'item.4_columns' => ['4 Columns', '4 Spalten', '4 colonnes', '4 columnas', '4 colonne'],
    'item.horizontal' => ['Horizontal', 'Horizontal', 'Horizontal', 'Horizontal', 'Orizzontale'],
    'item.vertical' => ['Vertical', 'Vertikal', 'Vertical', 'Vertical', 'Verticale'],
    'item.5_stars' => ['5 Stars', '5 Sterne', '5 étoiles', '5 estrellas', '5 stelle'],
    'item.4_stars' => ['4 Stars', '4 Sterne', '4 étoiles', '4 estrellas', '4 stelle'],
    'item.3_stars' => ['3 Stars', '3 Sterne', '3 étoiles', '3 estrellas', '3 stelle'],
    'item.basic' => ['Basic', 'Standard', 'Basique', 'Básico', 'Base'],
    'item.with_image' => ['With Image', 'Mit Bild', 'Avec image', 'Con imagen', 'Con immagine'],
    'item.card' => ['Card', 'Karte', 'Carte', 'Tarjeta', 'Scheda'],
    'item.large' => ['Large', 'Groß', 'Grand', 'Grande', 'Grande'],
    'item.bordered' => ['Bordered', 'Mit Rahmen', 'Avec bordure', 'Con borde', 'Con bordo'],
    'item.centered' => ['Centered', 'Zentriert', 'Centré', 'Centrado', 'Centrato'],
    'item.between' => ['Space Between', 'Gleichmäßig verteilt', 'Espacement égal', 'Espacio entre', 'Spazio tra'],
    'item.accent' => ['Accent', 'Akzent', 'Accent', 'Acento', 'Accento'],
    'item.outline' => ['Outline', 'Umriss', 'Contour', 'Contorno', 'Contorno'],
    'item.info' => ['Info', 'Info', 'Info', 'Info', 'Info'],
    'item.success' => ['Success', 'Erfolg', 'Succès', 'Éxito', 'Successo'],
    'item.warning' => ['Warning', 'Warnung', 'Avertissement', 'Advertencia', 'Avviso'],
    'item.destructive' => ['Destructive', 'Kritisch', 'Destructif', 'Destructivo', 'Distruttivo'],
    'item.simple' => ['Simple', 'Einfach', 'Simple', 'Simple', 'Semplice'],
    'item.split' => ['Split', 'Geteilt', 'Divisé', 'Dividido', 'Diviso'],
    'item.background' => ['Background', 'Hintergrund', 'Arrière-plan', 'Fondo', 'Sfondo'],
    'item.banner' => ['Banner', 'Banner', 'Bannière', 'Banner', 'Banner'],
    'item.stacked' => ['Stacked', 'Gestapelt', 'Empilé', 'Apilado', 'Impilato'],
    'item.icon_top' => ['Icon Top', 'Icon oben', 'Icône en haut', 'Icono arriba', 'Icona in alto'],
    'item.icon_left' => ['Icon Left', 'Icon links', 'Icône à gauche', 'Icono izquierda', 'Icona a sinistra'],
    'item.full_width' => ['Full Width', 'Volle Breite', 'Pleine largeur', 'Ancho completo', 'Larghezza piena'],
    'item.two_columns' => ['Two Columns', 'Zwei Spalten', 'Deux colonnes', 'Dos columnas', 'Due colonne'],
    'item.secondary' => ['Secondary', 'Sekundär', 'Secondaire', 'Secundario', 'Secondario'],
    'item.ghost' => ['Ghost', 'Transparent', 'Fantôme', 'Fantasma', 'Fantasma'],
    'item.primary' => ['Primary', 'Primär', 'Primaire', 'Primario', 'Primario'],
    'item.blue' => ['Blue', 'Blau', 'Bleu', 'Azul', 'Blu'],
    'item.green' => ['Green', 'Grün', 'Vert', 'Verde', 'Verde'],
    'item.orange' => ['Orange', 'Orange', 'Orange', 'Naranja', 'Arancione'],
    'item.red' => ['Red', 'Rot', 'Rouge', 'Rojo', 'Rosso'],
    'item.up' => ['Up', 'Aufwärts', 'En hausse', 'Arriba', 'In alto'],
    'item.down' => ['Down', 'Abwärts', 'En baisse', 'Abajo', 'In basso'],
    'item.neutral' => ['Neutral', 'Neutral', 'Neutre', 'Neutral', 'Neutro'],
    'item.muted' => ['Muted', 'Gedämpft', 'Atténué', 'Atenuado', 'Attenuato'],
    'item.none' => ['None', 'Keine', 'Aucun', 'Ninguno', 'Nessuno'],
];

// ──────────────────────────────────────────────────────────────
// Map inline labels to shared label keys
// ──────────────────────────────────────────────────────────────
$labelToKey = [];
foreach ($sharedLabels as $key => $translations) {
    $labelToKey[$translations[0]] = $key; // English text => key
}

// ──────────────────────────────────────────────────────────────
// Element title/description translations
// ──────────────────────────────────────────────────────────────
function translateTitle(string $title, string $lang): string {
    // Common prefixes/patterns for content element titles
    $prefixes = [
        'de' => ['Hero' => 'Hero', 'Feature' => 'Feature', 'Footer' => 'Footer', 'Navbar' => 'Navigationsleiste', 'CTA' => 'CTA', 'Card' => 'Karte', 'Chart' => 'Diagramm', 'Pricing' => 'Preise', 'Team' => 'Team', 'Testimonial' => 'Referenz', 'Newsletter' => 'Newsletter', 'Contact' => 'Kontakt', 'Login' => 'Anmeldung', 'Search' => 'Suche'],
        'fr' => ['Hero' => 'Héros', 'Feature' => 'Fonctionnalité', 'Footer' => 'Pied de page', 'Navbar' => 'Barre de navigation', 'CTA' => 'CTA', 'Card' => 'Carte', 'Chart' => 'Graphique', 'Pricing' => 'Tarifs', 'Team' => 'Équipe', 'Testimonial' => 'Témoignage', 'Newsletter' => 'Newsletter', 'Contact' => 'Contact', 'Login' => 'Connexion', 'Search' => 'Recherche'],
        'es' => ['Hero' => 'Hero', 'Feature' => 'Característica', 'Footer' => 'Pie de página', 'Navbar' => 'Barra de navegación', 'CTA' => 'CTA', 'Card' => 'Tarjeta', 'Chart' => 'Gráfico', 'Pricing' => 'Precios', 'Team' => 'Equipo', 'Testimonial' => 'Testimonio', 'Newsletter' => 'Boletín', 'Contact' => 'Contacto', 'Login' => 'Inicio de sesión', 'Search' => 'Búsqueda'],
        'it' => ['Hero' => 'Hero', 'Feature' => 'Funzionalità', 'Footer' => 'Piè di pagina', 'Navbar' => 'Barra di navigazione', 'CTA' => 'CTA', 'Card' => 'Scheda', 'Chart' => 'Grafico', 'Pricing' => 'Prezzi', 'Team' => 'Team', 'Testimonial' => 'Testimonianza', 'Newsletter' => 'Newsletter', 'Contact' => 'Contatto', 'Login' => 'Accesso', 'Search' => 'Ricerca'],
    ];

    if (!isset($prefixes[$lang])) return $title;

    $result = $title;
    foreach ($prefixes[$lang] as $en => $translated) {
        if (str_starts_with($result, $en . ' ') || $result === $en) {
            $result = $translated . substr($result, strlen($en));
            break;
        }
    }
    return $result;
}

// ──────────────────────────────────────────────────────────────
// XLIFF generation helpers
// ──────────────────────────────────────────────────────────────
function generateXlf(string $productName, array $units): string {
    $xml = '<?xml version="1.0" encoding="utf-8"?>' . "\n";
    $xml .= '<xliff version="1.2" xmlns="urn:oasis:names:tc:xliff:document:1.2">' . "\n";
    $xml .= '    <file source-language="en" datatype="plaintext" original="messages" product-name="' . htmlspecialchars($productName) . '">' . "\n";
    $xml .= '        <header/>' . "\n";
    $xml .= '        <body>' . "\n";
    foreach ($units as $id => $source) {
        $xml .= '            <trans-unit id="' . htmlspecialchars($id) . '">' . "\n";
        $xml .= '                <source>' . htmlspecialchars($source) . '</source>' . "\n";
        $xml .= '            </trans-unit>' . "\n";
    }
    $xml .= '        </body>' . "\n";
    $xml .= '    </file>' . "\n";
    $xml .= '</xliff>' . "\n";
    return $xml;
}

function generateTranslatedXlf(string $productName, string $targetLang, array $units): string {
    $xml = '<?xml version="1.0" encoding="utf-8"?>' . "\n";
    $xml .= '<xliff version="1.2" xmlns="urn:oasis:names:tc:xliff:document:1.2">' . "\n";
    $xml .= '    <file source-language="en" target-language="' . $targetLang . '" datatype="plaintext" original="messages" product-name="' . htmlspecialchars($productName) . '">' . "\n";
    $xml .= '        <header/>' . "\n";
    $xml .= '        <body>' . "\n";
    foreach ($units as $id => $data) {
        $xml .= '            <trans-unit id="' . htmlspecialchars($id) . '">' . "\n";
        $xml .= '                <source>' . htmlspecialchars($data['source']) . '</source>' . "\n";
        $xml .= '                <target>' . htmlspecialchars($data['target']) . '</target>' . "\n";
        $xml .= '            </trans-unit>' . "\n";
    }
    $xml .= '        </body>' . "\n";
    $xml .= '    </file>' . "\n";
    $xml .= '</xliff>' . "\n";
    return $xml;
}

// ──────────────────────────────────────────────────────────────
// Step 1: Generate shared labels.xlf
// ──────────────────────────────────────────────────────────────
echo "Generating shared labels...\n";

$enUnits = [];
foreach ($sharedLabels as $key => $translations) {
    $enUnits[$key] = $translations[0];
}
file_put_contents($sharedLangPath . '/labels.xlf', generateXlf('shadcn2fluid_templates', $enUnits));

$langCodes = ['de' => 1, 'fr' => 2, 'es' => 3, 'it' => 4];
foreach ($langCodes as $lang => $idx) {
    $units = [];
    foreach ($sharedLabels as $key => $translations) {
        $units[$key] = ['source' => $translations[0], 'target' => $translations[$idx]];
    }
    file_put_contents($sharedLangPath . '/' . $lang . '.labels.xlf', generateTranslatedXlf('shadcn2fluid_templates', $lang, $units));
}
echo "  Created shared labels: labels.xlf + 4 translations\n";

// ──────────────────────────────────────────────────────────────
// Step 2: Process each content element
// ──────────────────────────────────────────────────────────────
$elements = glob($contentElementsPath . '/*/config.yaml');
$updatedCount = 0;
$langFilesCreated = 0;

foreach ($elements as $configFile) {
    $elementDir = dirname($configFile);
    $elementName = basename($elementDir);
    $yaml = file_get_contents($configFile);
    if ($yaml === false) {
        echo "  WARNING: Could not read $elementName/config.yaml\n";
        continue;
    }
    try {
        $config = Yaml::parse($yaml);
    } catch (\Throwable $e) {
        echo "  WARNING: Could not parse $elementName/config.yaml: {$e->getMessage()}\n";
        continue;
    }
    if (!is_array($config)) {
        echo "  WARNING: Invalid YAML root in $elementName/config.yaml\n";
        continue;
    }

    $elementTitle = $config['title'] ?? ucwords(str_replace('-', ' ', $elementName));
    $elementDesc = $config['description'] ?? '';

    // Create language directory
    $langDir = $elementDir . '/language';
    if (!is_dir($langDir)) {
        mkdir($langDir, 0755, true);
    }

    // Generate per-element labels.xlf with title and description
    $elUnits = [
        'title' => $elementTitle,
        'description' => $elementDesc,
    ];
    file_put_contents($langDir . '/labels.xlf', generateXlf($elementName, $elUnits));

    // Generate translated versions
    foreach ($langCodes as $lang => $idx) {
        $translatedTitle = translateTitle($elementTitle, $lang);
        $translatedDesc = translateTitle($elementDesc, $lang);
        $units = [
            'title' => ['source' => $elementTitle, 'target' => $translatedTitle],
            'description' => ['source' => $elementDesc, 'target' => $translatedDesc],
        ];
        file_put_contents($langDir . '/' . $lang . '.labels.xlf', generateTranslatedXlf($elementName, $lang, $units));
    }
    $langFilesCreated += 5;

    // Update config.yaml: replace shared labels with LLL references
    $lllPrefix = 'LLL:EXT:shadcn2fluid_templates/Resources/Private/Language/labels.xlf:';
    $modified = false;

    if (isset($config['fields']) && is_array($config['fields'])) {
        foreach ($config['fields'] as &$field) {
            $modified |= updateFieldLabels($field, $lllPrefix, $labelToKey);
            // Process collection sub-fields
            if (isset($field['fields']) && is_array($field['fields'])) {
                foreach ($field['fields'] as &$subField) {
                    $modified |= updateFieldLabels($subField, $lllPrefix, $labelToKey);
                }
            }
        }
    }

    if ($modified) {
        // Rebuild YAML manually to preserve structure
        $newYaml = rebuildYaml($yaml, $lllPrefix, $labelToKey);
        file_put_contents($configFile, $newYaml);
        $updatedCount++;
    }
}

function updateFieldLabels(array &$field, string $lllPrefix, array $labelToKey): bool {
    $modified = false;
    if (isset($field['label']) && is_string($field['label'])) {
        $label = $field['label'];
        if (isset($labelToKey[$label]) && !str_starts_with($label, 'LLL:')) {
            $field['label'] = $lllPrefix . $labelToKey[$label];
            $modified = true;
        }
    }
    // Process select items
    if (isset($field['items']) && is_array($field['items'])) {
        foreach ($field['items'] as &$item) {
            if (isset($item['label']) && is_string($item['label'])) {
                $itemLabel = $item['label'];
                if (isset($labelToKey[$itemLabel]) && !str_starts_with($itemLabel, 'LLL:')) {
                    $item['label'] = $lllPrefix . $labelToKey[$itemLabel];
                    $modified = true;
                }
            }
        }
    }
    return $modified;
}

function rebuildYaml(string $yaml, string $lllPrefix, array $labelToKey): string {
    // Simple text-based replacement to preserve YAML formatting
    $lines = explode("\n", $yaml);
    $result = [];
    foreach ($lines as $line) {
        // Match field labels: "    label: Something"
        if (preg_match('/^(\s+label:\s+)(.+)$/', $line, $m)) {
            $labelValue = trim($m[2], "' \"");
            if (isset($labelToKey[$labelValue]) && !str_starts_with($labelValue, 'LLL:')) {
                $line = $m[1] . "'" . $lllPrefix . $labelToKey[$labelValue] . "'";
            }
        }
        // Match select item labels: "      - label: Something"
        if (preg_match('/^(\s+- label:\s+)(.+)$/', $line, $m)) {
            $labelValue = trim($m[2], "' \"");
            if (isset($labelToKey[$labelValue]) && !str_starts_with($labelValue, 'LLL:')) {
                $line = $m[1] . "'" . $lllPrefix . $labelToKey[$labelValue] . "'";
            }
        }
        $result[] = $line;
    }
    return implode("\n", $result);
}

echo "\nDone!\n";
echo "  Shared label files: 5 (labels.xlf + 4 translations)\n";
echo "  Per-element language files: $langFilesCreated\n";
echo "  Config.yaml files updated with LLL references: $updatedCount\n";
echo "  Total new files: " . (5 + $langFilesCreated) . "\n";
