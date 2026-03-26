<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Job;
use App\Models\Category;
use App\Models\Company;
use App\Models\Location;

class JobSeeder extends Seeder
{
    public function run(): void
    {
        $companies   = Company::all()->keyBy('company_name');
        $categories  = Category::all()->keyBy('name');
        $locations   = Location::all()->keyBy('name');

        // contact info per company
        $companyContact = [
            'TechNova AG'          => ['email' => 'contact@technova.ch',   'phone' => '+41 44 123 45 67'],
            'SwissMarketing GmbH'  => ['email' => 'info@swissmarketing.ch', 'phone' => '+41 44 987 65 43'],
            'BuildMaster SA'       => ['email' => 'jobs@buildmaster.ch',   'phone' => '+41 22 234 56 78'],
            'Helvetic IT Solutions'=> ['email' => 'hr@helveticit.ch',      'phone' => '+41 31 345 67 89'],
            'GreenEnergy Group'    => ['email' => 'careers@greenenergy.ch', 'phone' => '+41 27 456 78 90'],
        ];

        // canton / zip / language per location
        $locationMeta = [
            'Zürich'   => ['canton' => 'ZH', 'zip' => '8001', 'language' => 'Deutsch'],
            'Bern'     => ['canton' => 'BE', 'zip' => '3011', 'language' => 'Deutsch'],
            'Basel'    => ['canton' => 'BS', 'zip' => '4001', 'language' => 'Deutsch'],
            'Lausanne' => ['canton' => 'VD', 'zip' => '1001', 'language' => 'Französisch'],
            'Genf'     => ['canton' => 'GE', 'zip' => '1201', 'language' => 'Französisch'],
            'Sion'     => ['canton' => 'VS', 'zip' => '1950', 'language' => 'Französisch'],
            'Lugano'   => ['canton' => 'TI', 'zip' => '6901', 'language' => 'Italienisch'],
        ];

        $jobs = [
            [
                'company'   => 'TechNova AG',
                'category'  => 'Informatik',
                'location'  => 'Zürich',
                'title'     => 'Full-Stack Entwickler (m/w/d)',
                'description' => 'Als Full-Stack Entwickler verstärkst du unser agiles Produktteam in Zürich. Du entwickelst moderne Webanwendungen mit Vue.js im Frontend und Laravel im Backend, nimmst an Code Reviews teil und trägst aktiv zur Architekturentscheidungen bei. Du arbeitest eng mit dem Design- und Product-Team zusammen, um nutzerorientierte Features umzusetzen.',
                'home_office' => true,
                'workplace'  => 'Hybrid',
            ],
            [
                'company'   => 'TechNova AG',
                'category'  => 'Informatik',
                'location'  => 'Zürich',
                'title'     => 'Frontend Entwickler Vue.js (m/w/d)',
                'description' => 'Du gestaltest und implementierst ansprechende Benutzeroberflächen mit Vue 3 und TypeScript. In enger Zusammenarbeit mit UX-Designern setzt du Figma-Designs pixelgenau um, optimierst die Performance und stellst die Barrierefreiheit unserer Anwendungen sicher. Erfahrung mit Vite, Pinia und unit-Tests ist von Vorteil.',
                'home_office' => true,
                'workplace'  => 'Remote',
            ],
            [
                'company'   => 'Helvetic IT Solutions',
                'category'  => 'Informatik',
                'location'  => 'Bern',
                'title'     => 'DevOps Engineer (m/w/d)',
                'description' => 'Du verantwortest den Aufbau und Betrieb unserer CI/CD-Pipelines auf Basis von GitLab und Kubernetes. Du überwachst die Infrastruktur, automatisierst Deployments und arbeitest eng mit den Entwicklungsteams zusammen, um eine hohe Verfügbarkeit unserer Systeme sicherzustellen. Kenntnisse in Terraform und Prometheus sind ein Plus.',
                'home_office' => false,
                'workplace'  => 'Onsite',
            ],
            [
                'company'   => 'Helvetic IT Solutions',
                'category'  => 'Informatik',
                'location'  => 'Bern',
                'title'     => 'IT-Projektmanager (m/w/d)',
                'description' => 'Du leitest anspruchsvolle IT-Projekte von der Anforderungsanalyse bis zum Go-live. Du koordinierst interne und externe Stakeholder, erstellst Projektpläne, überwachst Budget und Zeitplan und sorgst für eine reibungslose Kommunikation zwischen allen Beteiligten. Erfahrung mit Scrum und Prince2 ist erwünscht.',
                'home_office' => true,
                'workplace'  => 'Hybrid',
            ],
            [
                'company'   => 'Helvetic IT Solutions',
                'category'  => 'Informatik',
                'location'  => 'Zürich',
                'title'     => 'Datenbankadministrator (m/w/d)',
                'description' => 'Als DBA bist du für die Administration, Optimierung und Sicherheit unserer MySQL- und PostgreSQL-Datenbanken zuständig. Du planst Backups, führst Performance-Tuning durch und unterstützt die Entwickler bei der Datenbankmodellierung. Erfahrung mit Cloud-Datenbanken (AWS RDS oder Azure) ist von Vorteil.',
                'home_office' => false,
                'workplace'  => 'Onsite',
            ],
            [
                'company'   => 'SwissMarketing GmbH',
                'category'  => 'Marketing',
                'location'  => 'Zürich',
                'title'     => 'Marketing Manager (m/w/d)',
                'description' => 'Du entwickelst und steuerst unsere Marketingstrategie für die DACH-Region. Du planst Kampagnen über alle Kanäle (Online, Print, Events), steuerst Agenturen, analysierst KPIs und leitest daraus Massnahmen ab. Erfahrung im B2B-Marketing sowie sehr gute Deutsch- und Englischkenntnisse werden vorausgesetzt.',
                'home_office' => true,
                'workplace'  => 'Hybrid',
            ],
            [
                'company'   => 'SwissMarketing GmbH',
                'category'  => 'Marketing',
                'location'  => 'Lausanne',
                'title'     => 'Content & Social Media Manager (m/w/d)',
                'description' => 'Du erstellst hochwertigen Content für unsere Social-Media-Kanäle, den Blog und Newsletter. Du analysierst Performance-Daten, optimierst Inhalte und entwickelst kreative Ideen für Kampagnen. Stilsicheres Schreiben auf Französisch und Deutsch sowie Erfahrung mit Tools wie Canva und Hootsuite setzen wir voraus.',
                'home_office' => true,
                'workplace'  => 'Remote',
            ],
            [
                'company'   => 'SwissMarketing GmbH',
                'category'  => 'Marketing',
                'location'  => 'Genf',
                'title'     => 'SEO / SEA Spezialist (m/w/d)',
                'description' => 'Du optimierst unsere Webseiten für Suchmaschinen und planst bezahlte Suchmaschinenkampagnen über Google Ads. Du analysierst Rankings, Klickraten und Conversion-Daten und leitest daraus konkrete Massnahmen ab. Kenntnisse in Google Search Console, Semrush und A/B-Testing sind erforderlich.',
                'home_office' => false,
                'workplace'  => 'Onsite',
            ],
            [
                'company'   => 'BuildMaster SA',
                'category'  => 'Baugewerbe',
                'location'  => 'Genf',
                'title'     => 'Bauleiter Hochbau (m/w/d)',
                'description' => 'Als Bauleiter koordinierst du alle Gewerke auf unseren Hochbauprojekten im Grossraum Genf. Du stellst die Einhaltung von Termin, Qualität und Budget sicher, führst das Baustellenpersonal und bist Ansprechperson für Bauherrschaft, Planer und Subunternehmer. Abgeschlossene Ausbildung als Polier oder Bauleiter mit eidg. Fachausweis erforderlich.',
                'home_office' => false,
                'workplace'  => 'Onsite',
            ],
            [
                'company'   => 'BuildMaster SA',
                'category'  => 'Baugewerbe',
                'location'  => 'Basel',
                'title'     => 'Maurer / Maurerin EFZ',
                'description' => 'Du führst Mauerarbeiten, Betonarbeiten und Abbrucharbeiten auf verschiedenen Baustellen in der Region Basel aus. Du arbeitest im Team, hältst Sicherheitsvorschriften ein und gehst sorgfältig mit Materialien und Maschinen um. Abgeschlossene Berufsausbildung als Maurer EFZ und Führerausweis Kat. B sind Voraussetzung.',
                'home_office' => false,
                'workplace'  => 'Onsite',
            ],
            [
                'company'   => 'BuildMaster SA',
                'category'  => 'Baugewerbe',
                'location'  => 'Genf',
                'title'     => 'Projektleiter Tiefbau (m/w/d)',
                'description' => 'Du planst und leitest Tiefbauprojekte (Strassen, Leitungen, Kanalisationen) von der Ausschreibung bis zur Abrechnung. Du führst dein Team vor Ort, kommunizierst mit Behörden und Auftraggebern und sorgst für die Einhaltung aller Sicherheits- und Qualitätsstandards.',
                'home_office' => false,
                'workplace'  => 'Onsite',
            ],
            [
                'company'   => 'TechNova AG',
                'category'  => 'Finanzen',
                'location'  => 'Zürich',
                'title'     => 'Finanzanalyst (m/w/d)',
                'description' => 'Du analysierst Finanz- und Businessdaten, erstellst Reports und Forecasts und unterstützt das Management bei strategischen Entscheidungen. Du arbeitest mit ERP-Systemen und BI-Tools, entwickelst Finanzmodelle in Excel und präsentierst Ergebnisse verständlich an verschiedene Stakeholder.',
                'home_office' => true,
                'workplace'  => 'Hybrid',
            ],
            [
                'company'   => 'Helvetic IT Solutions',
                'category'  => 'Finanzen',
                'location'  => 'Bern',
                'title'     => 'Buchhalter / Buchhalterin (m/w/d)',
                'description' => 'Du führst die Finanzbuchhaltung inklusive Debitoren, Kreditoren und Hauptbuch. Du erstellst Monats- und Jahresabschlüsse nach OR, wickelst den Zahlungsverkehr ab und bist Ansprechperson für Steuerberater und Revisoren. Kenntnisse in Abacus oder SAP sind von Vorteil.',
                'home_office' => false,
                'workplace'  => 'Onsite',
            ],
            [
                'company'   => 'TechNova AG',
                'category'  => 'Finanzen',
                'location'  => 'Basel',
                'title'     => 'Steuerberater / Steuerberaterin (m/w/d)',
                'description' => 'Du berätst unsere Klienten in allen Fragen des nationalen und internationalen Steuerrechts. Du erstellst Steuererklärungen für natürliche und juristische Personen, begleitest Steuerprüfungen und entwickelst steueroptimierte Lösungen. Ein Abschluss als diplomierter Steuerexperte oder vergleichbare Qualifikation wird vorausgesetzt.',
                'home_office' => true,
                'workplace'  => 'Hybrid',
            ],
            [
                'company'   => 'GreenEnergy Group',
                'category'  => 'Gesundheit',
                'location'  => 'Sion',
                'title'     => 'Pflegefachfrau / Pflegefachmann (m/w/d)',
                'description' => 'Du pflegst und betreust Patientinnen und Patienten in unserem Pflegezentrum im Wallis. Du führst pflegerische Massnahmen durch, dokumentierst den Pflegeverlauf und arbeitest eng mit dem interdisziplinären Team zusammen. Abschluss als dipl. Pflegefachperson HF oder FH sowie Sprachkenntnisse Deutsch/Französisch erforderlich.',
                'home_office' => false,
                'workplace'  => 'Onsite',
            ],
            [
                'company'   => 'GreenEnergy Group',
                'category'  => 'Gesundheit',
                'location'  => 'Lugano',
                'title'     => 'Medizinische Praxisassistentin (m/w/d)',
                'description' => 'Du empfängst Patienten, koordinierst Termine, assistierst bei medizinischen Untersuchungen und pflegst die Patientendossiers. Du bist erste Ansprechperson am Empfang und am Telefon und sorgst für einen reibungslosen Praxisablauf. MPA-Diplom und Italiano-Kenntnisse sind erforderlich.',
                'home_office' => false,
                'workplace'  => 'Onsite',
            ],
            [
                'company'   => 'GreenEnergy Group',
                'category'  => 'Gesundheit',
                'location'  => 'Bern',
                'title'     => 'Fachperson Gesundheit (FaGe) (m/w/d)',
                'description' => 'Du unterstützt das Pflegeteam bei der Betreuung und Pflege von betagten Menschen in unserem Alters- und Pflegeheim. Du hilfst bei der Körperpflege, der Mobilisation und den Mahlzeiten, dokumentierst deine Tätigkeiten und nimmst an Teambesprechungen teil. EFZ als Fachperson Gesundheit wird vorausgesetzt.',
                'home_office' => false,
                'workplace'  => 'Onsite',
            ],
            [
                'company'   => 'BuildMaster SA',
                'category'  => 'Logistik',
                'location'  => 'Basel',
                'title'     => 'Lagerlogistiker / Lagerlogistikerin EFZ',
                'description' => 'Du nimmst Waren an, prüfst die Lieferscheine, lagerst Güter fachgerecht ein und kommissionierst Bestellungen. Du bedienst Flurförderzeuge, führst Inventuren durch und pflegst die Lagerverwaltungssoftware. EFZ als Lagerlogistiker und Staplerschein sind Voraussetzung.',
                'home_office' => false,
                'workplace'  => 'Onsite',
            ],
            [
                'company'   => 'Helvetic IT Solutions',
                'category'  => 'Logistik',
                'location'  => 'Zürich',
                'title'     => 'Speditionskauffrau / Speditionskaufmann (m/w/d)',
                'description' => 'Du organisierst nationale und internationale Transporte, erstellst Frachtdokumente, koordinierst Zollabfertigungen und bist Ansprechperson für Kunden und Spediteure. Du überwachst Sendungsverläufe, optimierst Prozesse und arbeitest eng mit dem Einkauf zusammen.',
                'home_office' => true,
                'workplace'  => 'Hybrid',
            ],
            [
                'company'   => 'BuildMaster SA',
                'category'  => 'Logistik',
                'location'  => 'Lugano',
                'title'     => 'Einkäufer / Einkäuferin Logistik (m/w/d)',
                'description' => 'Du beschaffst Materialien, Verbrauchsgüter und Dienstleistungen für unsere Bauprojekte im Tessin. Du verhandelst Konditionen mit Lieferanten, überwachst Liefertermine und optimierst die Beschaffungskosten. Erfahrung im Bau-Einkauf und Kenntnisse in Italiano sowie Deutsch sind erforderlich.',
                'home_office' => false,
                'workplace'  => 'Onsite',
            ],
        ];

        foreach ($jobs as $data) {
            $meta    = $locationMeta[$data['location']];
            $contact = $companyContact[$data['company']];

            Job::create([
                'company_id'  => $companies[$data['company']]->id,
                'category_id' => $categories[$data['category']]->id,
                'location_id' => $locations[$data['location']]->id,
                'title'       => $data['title'],
                'description' => $data['description'],
                'canton'      => $meta['canton'],
                'zip'         => $meta['zip'],
                'home_office' => $data['home_office'],
                'language'    => $meta['language'],
                'workplace'   => $data['workplace'],
                'email'       => $contact['email'],
                'phone'       => $contact['phone'],
            ]);
        }
    }
}
