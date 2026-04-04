#!/usr/bin/env python3
"""
Generate translation files for all 250 content elements.
Creates shared labels + per-element translations in DE, FR, ES, IT.
Updates config.yaml to use LLL: references for shared labels.
"""

import os, re, glob, html

BASE = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
CE_PATH = os.path.join(BASE, 'ContentBlocks', 'ContentElements')
LANG_PATH = os.path.join(BASE, 'Resources', 'Private', 'Language')
LLL = 'LLL:EXT:shadcn2fluid_templates/Resources/Private/Language/labels.xlf:'

os.makedirs(LANG_PATH, exist_ok=True)

# ── Shared labels: key => [en, de, fr, es, it] ──
SHARED = {
    'heading': ['Heading', 'Überschrift', 'Titre', 'Encabezado', 'Intestazione'],
    'description': ['Description', 'Beschreibung', 'Description', 'Descripción', 'Descrizione'],
    'subheadline': ['Subheadline', 'Unterüberschrift', 'Sous-titre', 'Subtítulo', 'Sottotitolo'],
    'eyebrow': ['Eyebrow', 'Dachzeile', 'Surtitre', 'Ceja', 'Sopratitolo'],
    'button_text': ['Button Text', 'Button-Text', 'Texte du bouton', 'Texto del botón', 'Testo pulsante'],
    'button_link': ['Button Link', 'Button-Link', 'Lien du bouton', 'Enlace del botón', 'Link pulsante'],
    'label_field': ['Label', 'Bezeichnung', 'Libellé', 'Etiqueta', 'Etichetta'],
    'link': ['Link', 'Link', 'Lien', 'Enlace', 'Link'],
    'optional_link': ['Optional Link', 'Optionaler Link', 'Lien optionnel', 'Enlace opcional', 'Link opzionale'],
    'link_text': ['Link Text', 'Linktext', 'Texte du lien', 'Texto del enlace', 'Testo link'],
    'title': ['Title', 'Titel', 'Titre', 'Título', 'Titolo'],
    'image': ['Image', 'Bild', 'Image', 'Imagen', 'Immagine'],
    'name': ['Name', 'Name', 'Nom', 'Nombre', 'Nome'],
    'content': ['Content', 'Inhalt', 'Contenu', 'Contenido', 'Contenuto'],
    'text': ['Text', 'Text', 'Texte', 'Texto', 'Testo'],
    'style': ['Style', 'Stil', 'Style', 'Estilo', 'Stile'],
    'layout': ['Layout', 'Layout', 'Disposition', 'Diseño', 'Layout'],
    'columns': ['Columns', 'Spalten', 'Colonnes', 'Columnas', 'Colonne'],
    'alignment': ['Alignment', 'Ausrichtung', 'Alignement', 'Alineación', 'Allineamento'],
    'text_alignment': ['Text Alignment', 'Textausrichtung', 'Alignement du texte', 'Alineación del texto', 'Allineamento testo'],
    'primary_button_text': ['Primary Button Text', 'Primärer Button-Text', 'Texte bouton principal', 'Texto botón primario', 'Testo pulsante primario'],
    'primary_button_link': ['Primary Button Link', 'Primärer Button-Link', 'Lien bouton principal', 'Enlace botón primario', 'Link pulsante primario'],
    'secondary_button_text': ['Secondary Button Text', 'Sekundärer Button-Text', 'Texte bouton secondaire', 'Texto botón secundario', 'Testo pulsante secondario'],
    'secondary_button_link': ['Secondary Button Link', 'Sekundärer Button-Link', 'Lien bouton secondaire', 'Enlace botón secundario', 'Link pulsante secondario'],
    'badge_text': ['Badge Text', 'Badge-Text', 'Texte du badge', 'Texto de insignia', 'Testo badge'],
    'background_image': ['Background Image', 'Hintergrundbild', "Image d'arrière-plan", 'Imagen de fondo', 'Immagine di sfondo'],
    'author_name': ['Author Name', 'Autorenname', "Nom de l'auteur", 'Nombre del autor', 'Nome autore'],
    'author_role': ['Author Role', 'Autorenrolle', "Rôle de l'auteur", 'Rol del autor', 'Ruolo autore'],
    'author_title': ['Author Title', 'Autorentitel', "Titre de l'auteur", 'Título del autor', 'Titolo autore'],
    'author_photo': ['Author Photo', 'Autorenfoto', "Photo de l'auteur", 'Foto del autor', 'Foto autore'],
    'copyright_text': ['Copyright Text', 'Copyright-Text', 'Texte de copyright', 'Texto de copyright', 'Testo copyright'],
    'price': ['Price', 'Preis', 'Prix', 'Precio', 'Prezzo'],
    'rating': ['Rating', 'Bewertung', 'Évaluation', 'Valoración', 'Valutazione'],
    'brand': ['Brand', 'Marke', 'Marque', 'Marca', 'Marchio'],
    'brand_name': ['Brand Name', 'Markenname', 'Nom de marque', 'Nombre de marca', 'Nome marchio'],
    'brand_link': ['Brand Link', 'Marken-Link', 'Lien de marque', 'Enlace de marca', 'Link marchio'],
    'form_action': ['Form Action', 'Formular-URL', 'Action du formulaire', 'Acción del formulario', 'Azione modulo'],
    'features': ['Features', 'Funktionen', 'Fonctionnalités', 'Características', 'Funzionalità'],
    'features_one_per_line': ['Features (one per line)', 'Funktionen (eine pro Zeile)', 'Fonctionnalités (une par ligne)', 'Características (una por línea)', 'Funzionalità (una per riga)'],
    'portrait': ['Portrait', 'Porträt', 'Portrait', 'Retrato', 'Ritratto'],
    'value': ['Value', 'Wert', 'Valeur', 'Valor', 'Valore'],
    'role': ['Role', 'Rolle', 'Rôle', 'Rol', 'Ruolo'],
    'logo': ['Logo', 'Logo', 'Logo', 'Logo', 'Logo'],
    'short_description': ['Short Description', 'Kurzbeschreibung', 'Description courte', 'Descripción breve', 'Descrizione breve'],
    'company_name': ['Company Name', 'Firmenname', "Nom de l'entreprise", 'Nombre de la empresa', 'Nome azienda'],
    'icon_emoji': ['Icon Emoji or Symbol', 'Icon-Emoji oder Symbol', 'Icône emoji ou symbole', 'Emoji o símbolo de icono', 'Emoji o simbolo icona'],
    'navigation_items': ['Navigation Items', 'Navigationselemente', 'Éléments de navigation', 'Elementos de navegación', 'Elementi di navigazione'],
    'links': ['Links', 'Links', 'Liens', 'Enlaces', 'Link'],
    'links_one_per_line': ['Links (one per line)', 'Links (einer pro Zeile)', 'Liens (un par ligne)', 'Enlaces (uno por línea)', 'Link (uno per riga)'],
    'items': ['Items', 'Einträge', 'Éléments', 'Elementos', 'Elementi'],
    'plans': ['Plans', 'Tarife', 'Plans', 'Planes', 'Piani'],
    'chart_data_json': ['Chart Data (JSON)', 'Diagrammdaten (JSON)', 'Données du graphique (JSON)', 'Datos del gráfico (JSON)', 'Dati grafico (JSON)'],
    'show_more_link': ['Show More Link', 'Mehr-anzeigen-Link', 'Lien voir plus', 'Enlace ver más', 'Link mostra altro'],
    'placeholder_text': ['Placeholder Text', 'Platzhaltertext', 'Texte de remplacement', 'Texto de marcador', 'Testo segnaposto'],
    'submit_text': ['Submit Text', 'Absenden-Text', 'Texte de soumission', 'Texto de envío', 'Testo invio'],
    'consent_text': ['Consent Text', 'Einwilligungstext', 'Texte de consentement', 'Texto de consentimiento', 'Testo consenso'],
    'success_message': ['Success Message', 'Erfolgsmeldung', 'Message de succès', 'Mensaje de éxito', 'Messaggio di successo'],
    'currency': ['Currency', 'Währung', 'Devise', 'Moneda', 'Valuta'],
    'period': ['Period', 'Zeitraum', 'Période', 'Período', 'Periodo'],
    'highlighted': ['Highlighted', 'Hervorgehoben', 'Mis en avant', 'Destacado', 'In evidenza'],
    'product_image': ['Product Image', 'Produktbild', 'Image du produit', 'Imagen del producto', 'Immagine prodotto'],
    'column_content': ['Column Content', 'Spalteninhalt', 'Contenu de colonne', 'Contenido de columna', 'Contenuto colonna'],
    'target_date': ['Target Date', 'Zieldatum', 'Date cible', 'Fecha objetivo', 'Data obiettivo'],
    'show_labels': ['Show Labels', 'Beschriftungen anzeigen', 'Afficher les étiquettes', 'Mostrar etiquetas', 'Mostra etichette'],
    'show_grid': ['Show Grid', 'Raster anzeigen', 'Afficher la grille', 'Mostrar cuadrícula', 'Mostra griglia'],
    'card_style': ['Card Style', 'Kartenstil', 'Style de carte', 'Estilo de tarjeta', 'Stile scheda'],
    'layout_variant': ['Layout Variant', 'Layout-Variante', 'Variante de disposition', 'Variante de diseño', 'Variante layout'],
    'color_field': ['Color', 'Farbe', 'Couleur', 'Color', 'Colore'],
    'trend': ['Trend', 'Trend', 'Tendance', 'Tendencia', 'Tendenza'],
    'image_position': ['Image Position', 'Bildposition', "Position de l'image", 'Posición de imagen', 'Posizione immagine'],
    'position': ['Position', 'Position', 'Position', 'Posición', 'Posizione'],
    # Select items
    'item.left': ['Left', 'Links', 'Gauche', 'Izquierda', 'Sinistra'],
    'item.center': ['Center', 'Zentriert', 'Centré', 'Centrado', 'Centrato'],
    'item.right': ['Right', 'Rechts', 'Droite', 'Derecha', 'Destra'],
    'item.default': ['Default', 'Standard', 'Par défaut', 'Predeterminado', 'Predefinito'],
    'item.2_columns': ['2 Columns', '2 Spalten', '2 colonnes', '2 columnas', '2 colonne'],
    'item.3_columns': ['3 Columns', '3 Spalten', '3 colonnes', '3 columnas', '3 colonne'],
    'item.4_columns': ['4 Columns', '4 Spalten', '4 colonnes', '4 columnas', '4 colonne'],
    'item.horizontal': ['Horizontal', 'Horizontal', 'Horizontal', 'Horizontal', 'Orizzontale'],
    'item.vertical': ['Vertical', 'Vertikal', 'Vertical', 'Vertical', 'Verticale'],
    'item.5_stars': ['5 Stars', '5 Sterne', '5 étoiles', '5 estrellas', '5 stelle'],
    'item.4_stars': ['4 Stars', '4 Sterne', '4 étoiles', '4 estrellas', '4 stelle'],
    'item.3_stars': ['3 Stars', '3 Sterne', '3 étoiles', '3 estrellas', '3 stelle'],
    'item.basic': ['Basic', 'Standard', 'Basique', 'Básico', 'Base'],
    'item.with_image': ['With Image', 'Mit Bild', 'Avec image', 'Con imagen', 'Con immagine'],
    'item.card': ['Card', 'Karte', 'Carte', 'Tarjeta', 'Scheda'],
    'item.large': ['Large', 'Groß', 'Grand', 'Grande', 'Grande'],
    'item.bordered': ['Bordered', 'Mit Rahmen', 'Avec bordure', 'Con borde', 'Con bordo'],
    'item.centered': ['Centered', 'Zentriert', 'Centré', 'Centrado', 'Centrato'],
    'item.between': ['Space Between', 'Gleichmäßig verteilt', 'Espacement égal', 'Espacio entre', 'Spazio tra'],
    'item.accent': ['Accent', 'Akzent', 'Accent', 'Acento', 'Accento'],
    'item.outline': ['Outline', 'Umriss', 'Contour', 'Contorno', 'Contorno'],
    'item.info': ['Info', 'Info', 'Info', 'Info', 'Info'],
    'item.success': ['Success', 'Erfolg', 'Succès', 'Éxito', 'Successo'],
    'item.warning': ['Warning', 'Warnung', 'Avertissement', 'Advertencia', 'Avviso'],
    'item.destructive': ['Destructive', 'Kritisch', 'Destructif', 'Destructivo', 'Distruttivo'],
    'item.simple': ['Simple', 'Einfach', 'Simple', 'Simple', 'Semplice'],
    'item.split': ['Split', 'Geteilt', 'Divisé', 'Dividido', 'Diviso'],
    'item.background': ['Background', 'Hintergrund', 'Arrière-plan', 'Fondo', 'Sfondo'],
    'item.banner': ['Banner', 'Banner', 'Bannière', 'Banner', 'Banner'],
    'item.stacked': ['Stacked', 'Gestapelt', 'Empilé', 'Apilado', 'Impilato'],
    'item.icon_top': ['Icon Top', 'Icon oben', 'Icône en haut', 'Icono arriba', 'Icona in alto'],
    'item.icon_left': ['Icon Left', 'Icon links', 'Icône à gauche', 'Icono izquierda', 'Icona a sinistra'],
    'item.full_width': ['Full Width', 'Volle Breite', 'Pleine largeur', 'Ancho completo', 'Larghezza piena'],
    'item.two_columns': ['Two Columns', 'Zwei Spalten', 'Deux colonnes', 'Dos columnas', 'Due colonne'],
    'item.secondary': ['Secondary', 'Sekundär', 'Secondaire', 'Secundario', 'Secondario'],
    'item.ghost': ['Ghost', 'Transparent', 'Fantôme', 'Fantasma', 'Fantasma'],
    'item.primary': ['Primary', 'Primär', 'Primaire', 'Primario', 'Primario'],
    'item.blue': ['Blue', 'Blau', 'Bleu', 'Azul', 'Blu'],
    'item.green': ['Green', 'Grün', 'Vert', 'Verde', 'Verde'],
    'item.orange': ['Orange', 'Orange', 'Orange', 'Naranja', 'Arancione'],
    'item.red': ['Red', 'Rot', 'Rouge', 'Rojo', 'Rosso'],
    'item.up': ['Up', 'Aufwärts', 'En hausse', 'Arriba', 'In alto'],
    'item.down': ['Down', 'Abwärts', 'En baisse', 'Abajo', 'In basso'],
    'item.neutral': ['Neutral', 'Neutral', 'Neutre', 'Neutral', 'Neutro'],
    'item.muted': ['Muted', 'Gedämpft', 'Atténué', 'Atenuado', 'Attenuato'],
    'item.none': ['None', 'Keine', 'Aucun', 'Ninguno', 'Nessuno'],
}

# Build reverse lookup: English label text => key
LABEL_TO_KEY = {}
for key, translations in SHARED.items():
    LABEL_TO_KEY[translations[0]] = key

LANGS = {'de': 1, 'fr': 2, 'es': 3, 'it': 4}

def esc(s):
    return html.escape(str(s))

def make_xlf(product, units):
    lines = ['<?xml version="1.0" encoding="utf-8"?>',
             '<xliff version="1.2" xmlns="urn:oasis:names:tc:xliff:document:1.2">',
             f'    <file source-language="en" datatype="plaintext" original="messages" product-name="{esc(product)}">',
             '        <header/>',
             '        <body>']
    for tid, src in units.items():
        lines += [f'            <trans-unit id="{esc(tid)}">',
                  f'                <source>{esc(src)}</source>',
                  '            </trans-unit>']
    lines += ['        </body>', '    </file>', '</xliff>', '']
    return '\n'.join(lines)

def make_xlf_translated(product, lang, units):
    lines = ['<?xml version="1.0" encoding="utf-8"?>',
             '<xliff version="1.2" xmlns="urn:oasis:names:tc:xliff:document:1.2">',
             f'    <file source-language="en" target-language="{lang}" datatype="plaintext" original="messages" product-name="{esc(product)}">',
             '        <header/>',
             '        <body>']
    for tid, (src, tgt) in units.items():
        lines += [f'            <trans-unit id="{esc(tid)}">',
                  f'                <source>{esc(src)}</source>',
                  f'                <target>{esc(tgt)}</target>',
                  '            </trans-unit>']
    lines += ['        </body>', '    </file>', '</xliff>', '']
    return '\n'.join(lines)

# ── Step 1: Write shared labels ──
print("Creating shared labels...")
en_units = {k: v[0] for k, v in SHARED.items()}
with open(os.path.join(LANG_PATH, 'labels.xlf'), 'w') as f:
    f.write(make_xlf('shadcn2fluid_templates', en_units))

for lang, idx in LANGS.items():
    units = {k: (v[0], v[idx]) for k, v in SHARED.items()}
    with open(os.path.join(LANG_PATH, f'{lang}.labels.xlf'), 'w') as f:
        f.write(make_xlf_translated('shadcn2fluid_templates', lang, units))
print("  5 shared label files created")

# ── Step 2: Process each content element ──
configs = sorted(glob.glob(os.path.join(CE_PATH, '*/config.yaml')))
created = 0
updated = 0

# Simple title translation for element titles
def translate_title(title, lang):
    prefixes = {
        'de': {'Hero': 'Hero', 'Feature': 'Feature', 'Footer': 'Footer', 'Navbar': 'Navigationsleiste',
               'CTA': 'CTA', 'Card': 'Karte', 'Chart': 'Diagramm', 'Pricing': 'Preise',
               'Team': 'Team', 'Testimonial': 'Referenz', 'Newsletter': 'Newsletter',
               'Contact': 'Kontakt', 'Login': 'Anmeldung', 'Search': 'Suche'},
        'fr': {'Hero': 'Héros', 'Feature': 'Fonctionnalité', 'Footer': 'Pied de page',
               'Navbar': 'Barre de navigation', 'CTA': 'CTA', 'Card': 'Carte',
               'Chart': 'Graphique', 'Pricing': 'Tarifs', 'Team': 'Équipe',
               'Testimonial': 'Témoignage', 'Contact': 'Contact', 'Search': 'Recherche'},
        'es': {'Hero': 'Hero', 'Feature': 'Característica', 'Footer': 'Pie de página',
               'Navbar': 'Barra de navegación', 'CTA': 'CTA', 'Card': 'Tarjeta',
               'Chart': 'Gráfico', 'Pricing': 'Precios', 'Team': 'Equipo',
               'Testimonial': 'Testimonio', 'Contact': 'Contacto', 'Search': 'Búsqueda'},
        'it': {'Hero': 'Hero', 'Feature': 'Funzionalità', 'Footer': 'Piè di pagina',
               'Navbar': 'Barra di navigazione', 'CTA': 'CTA', 'Card': 'Scheda',
               'Chart': 'Grafico', 'Pricing': 'Prezzi', 'Team': 'Team',
               'Testimonial': 'Testimonianza', 'Contact': 'Contatto', 'Search': 'Ricerca'},
    }
    if lang not in prefixes:
        return title
    for en, tr in prefixes[lang].items():
        if title.startswith(en + ' ') or title == en:
            return tr + title[len(en):]
    return title

for cfg_path in configs:
    elem_dir = os.path.dirname(cfg_path)
    elem_name = os.path.basename(elem_dir)

    with open(cfg_path) as f:
        yaml_text = f.read()

    # Extract title and description from YAML (simple regex)
    title_m = re.search(r'^title:\s*(.+)$', yaml_text, re.MULTILINE)
    desc_m = re.search(r'^description:\s*(.+)$', yaml_text, re.MULTILINE)
    elem_title = title_m.group(1).strip().strip("'\"") if title_m else elem_name.replace('-', ' ').title()
    elem_desc = desc_m.group(1).strip().strip("'\"") if desc_m else ''

    # Create language directory
    lang_dir = os.path.join(elem_dir, 'language')
    os.makedirs(lang_dir, exist_ok=True)

    # Write per-element labels.xlf
    el_units = {'title': elem_title, 'description': elem_desc}
    with open(os.path.join(lang_dir, 'labels.xlf'), 'w') as f:
        f.write(make_xlf(elem_name, el_units))

    for lang, idx in LANGS.items():
        t_title = translate_title(elem_title, lang)
        t_desc = translate_title(elem_desc, lang)
        units = {'title': (elem_title, t_title), 'description': (elem_desc, t_desc)}
        with open(os.path.join(lang_dir, f'{lang}.labels.xlf'), 'w') as f:
            f.write(make_xlf_translated(elem_name, lang, units))
    created += 5

    # Update config.yaml: replace shared labels with LLL references
    new_yaml = yaml_text
    changed = False

    for line in yaml_text.split('\n'):
        # Match "    label: Something" or "      - label: Something"
        m = re.match(r'^(\s+(?:- )?label:\s+)(.+)$', line)
        if m:
            label_val = m.group(2).strip().strip("'\"")
            if label_val in LABEL_TO_KEY and not label_val.startswith('LLL:'):
                key = LABEL_TO_KEY[label_val]
                new_line = f"{m.group(1)}'{LLL}{key}'"
                new_yaml = new_yaml.replace(line, new_line, 1)
                changed = True

    if changed:
        with open(cfg_path, 'w') as f:
            f.write(new_yaml)
        updated += 1

print(f"\nDone!")
print(f"  Per-element language files created: {created}")
print(f"  config.yaml files updated with LLL refs: {updated}")
print(f"  Total new files: {5 + created}")
