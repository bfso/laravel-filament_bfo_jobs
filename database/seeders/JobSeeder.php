<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Company;
use App\Models\Job;
use App\Models\Location;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    public function run(): void
    {
        $companies = Company::all()->keyBy('company_name');
        $categories = Category::all()->keyBy('name');
        $locations = Location::all()->keyBy('name');

        if ($companies->isEmpty() || $categories->isEmpty() || $locations->isEmpty()) {
            return;
        }

        $companyContact = [
            'TechNova AG' => ['email' => 'contact@technova.ch', 'phone' => '+41 44 123 45 67'],
            'SwissMarketing GmbH' => ['email' => 'info@swissmarketing.ch', 'phone' => '+41 44 987 65 43'],
            'BuildMaster SA' => ['email' => 'jobs@buildmaster.ch', 'phone' => '+41 22 234 56 78'],
            'Helvetic IT Solutions' => ['email' => 'hr@helveticit.ch', 'phone' => '+41 31 345 67 89'],
            'GreenEnergy Group' => ['email' => 'careers@greenenergy.ch', 'phone' => '+41 27 456 78 90'],
        ];

        $locationMeta = [
            'ZÃ¼rich' => ['canton' => 'ZH', 'zip' => '8001', 'language' => 'Deutsch'],
            'Bern' => ['canton' => 'BE', 'zip' => '3011', 'language' => 'Deutsch'],
            'Basel' => ['canton' => 'BS', 'zip' => '4001', 'language' => 'Deutsch'],
            'Lausanne' => ['canton' => 'VD', 'zip' => '1001', 'language' => 'FranzÃ¶sisch'],
            'Genf' => ['canton' => 'GE', 'zip' => '1201', 'language' => 'FranzÃ¶sisch'],
            'Sion' => ['canton' => 'VS', 'zip' => '1950', 'language' => 'FranzÃ¶sisch'],
            'Lugano' => ['canton' => 'TI', 'zip' => '6901', 'language' => 'Italienisch'],
        ];

        $jobs = [
            [
                'company' => 'TechNova AG',
                'category' => 'Informatik',
                'location' => 'ZÃ¼rich',
                'title' => 'Full-Stack Entwickler (m/w/d)',
                'description' => 'Als Full-Stack Entwickler verstÃ¤rkst du unser agiles Produktteam in ZÃ¼rich. Du entwickelst moderne Webanwendungen mit Vue.js im Frontend und Laravel im Backend, nimmst an Code Reviews teil und trÃ¤gst aktiv zur Architekturentscheidungen bei. Du arbeitest eng mit dem Design- und Product-Team zusammen, um nutzerorientierte Features umzusetzen.',
                'home_office' => true,
                'workplace' => 'Hybrid',
            ],
            [
                'company' => 'TechNova AG',
                'category' => 'Informatik',
                'location' => 'ZÃ¼rich',
                'title' => 'Frontend Entwickler Vue.js (m/w/d)',
                'description' => 'Du gestaltest und implementierst ansprechende BenutzeroberflÃ¤chen mit Vue 3 und TypeScript. In enger Zusammenarbeit mit UX-Designern setzt du Figma-Designs pixelgenau um, optimierst die Performance und stellst die Barrierefreiheit unserer Anwendungen sicher. Erfahrung mit Vite, Pinia und unit-Tests ist von Vorteil.',
                'home_office' => true,
                'workplace' => 'Remote',
            ],
            [
                'company' => 'Helvetic IT Solutions',
                'category' => 'Informatik',
                'location' => 'Bern',
                'title' => 'DevOps Engineer (m/w/d)',
                'description' => 'Du verantwortest den Aufbau und Betrieb unserer CI/CD-Pipelines auf Basis von GitLab und Kubernetes. Du Ã¼berwachst die Infrastruktur, automatisierst Deployments und arbeitest eng mit den Entwicklungsteams zusammen, um eine hohe VerfÃ¼gbarkeit unserer Systeme sicherzustellen. Kenntnisse in Terraform und Prometheus sind ein Plus.',
                'home_office' => false,
                'workplace' => 'Onsite',
            ],
            [
                'company' => 'Helvetic IT Solutions',
                'category' => 'Informatik',
                'location' => 'Bern',
                'title' => 'IT-Projektmanager (m/w/d)',
                'description' => 'Du leitest anspruchsvolle IT-Projekte von der Anforderungsanalyse bis zum Go-live. Du koordinierst interne und externe Stakeholder, erstellst ProjektplÃ¤ne, Ã¼berwachst Budget und Zeitplan und sorgst fÃ¼r eine reibungslose Kommunikation zwischen allen Beteiligten. Erfahrung mit Scrum und Prince2 ist erwÃ¼nscht.',
                'home_office' => true,
                'workplace' => 'Hybrid',
            ],
            [
                'company' => 'Helvetic IT Solutions',
                'category' => 'Informatik',
                'location' => 'ZÃ¼rich',
                'title' => 'Datenbankadministrator (m/w/d)',
                'description' => 'Als DBA bist du fÃ¼r die Administration, Optimierung und Sicherheit unserer MySQL- und PostgreSQL-Datenbanken zustÃ¤ndig. Du planst Backups, fÃ¼hrst Performance-Tuning durch und unterstÃ¼tzt die Entwickler bei der Datenbankmodellierung. Erfahrung mit Cloud-Datenbanken (AWS RDS oder Azure) ist von Vorteil.',
                'home_office' => false,
                'workplace' => 'Onsite',
            ],
            [
                'company' => 'SwissMarketing GmbH',
                'category' => 'Marketing',
                'location' => 'ZÃ¼rich',
                'title' => 'Marketing Manager (m/w/d)',
                'description' => 'Du entwickelst und steuerst unsere Marketingstrategie fÃ¼r die DACH-Region. Du planst Kampagnen Ã¼ber alle KanÃ¤le (Online, Print, Events), steuerst Agenturen, analysierst KPIs und leitest daraus Massnahmen ab. Erfahrung im B2B-Marketing sowie sehr gute Deutsch- und Englischkenntnisse werden vorausgesetzt.',
                'home_office' => true,
                'workplace' => 'Hybrid',
            ],
            [
                'company' => 'SwissMarketing GmbH',
                'category' => 'Marketing',
                'location' => 'Lausanne',
                'title' => 'Content & Social Media Manager (m/w/d)',
                'description' => 'Du erstellst hochwertigen Content fÃ¼r unsere Social-Media-KanÃ¤le, den Blog und Newsletter. Du analysierst Performance-Daten, optimierst Inhalte und entwickelst kreative Ideen fÃ¼r Kampagnen. Stilsicheres Schreiben auf FranzÃ¶sisch und Deutsch sowie Erfahrung mit Tools wie Canva und Hootsuite setzen wir voraus.',
                'home_office' => true,
                'workplace' => 'Remote',
            ],
            [
                'company' => 'SwissMarketing GmbH',
                'category' => 'Marketing',
                'location' => 'Genf',
                'title' => 'SEO / SEA Spezialist (m/w/d)',
                'description' => 'Du optimierst unsere Webseiten fÃ¼r Suchmaschinen und planst bezahlte Suchmaschinenkampagnen Ã¼ber Google Ads. Du analysierst Rankings, Klickraten und Conversion-Daten und leitest daraus konkrete Massnahmen ab. Kenntnisse in Google Search Console, Semrush und A/B-Testing sind erforderlich.',
                'home_office' => false,
                'workplace' => 'Onsite',
            ],
            [
                'company' => 'BuildMaster SA',
                'category' => 'Baugewerbe',
                'location' => 'Genf',
                'title' => 'Bauleiter Hochbau (m/w/d)',
                'description' => 'Als Bauleiter koordinierst du alle Gewerke auf unseren Hochbauprojekten im Grossraum Genf. Du stellst die Einhaltung von Termin, QualitÃ¤t und Budget sicher, fÃ¼hrst das Baustellenpersonal und bist Ansprechperson fÃ¼r Bauherrschaft, Planer und Subunternehmer. Abgeschlossene Ausbildung als Polier oder Bauleiter mit eidg. Fachausweis erforderlich.',
                'home_office' => false,
                'workplace' => 'Onsite',
            ],
            [
                'company' => 'BuildMaster SA',
                'category' => 'Baugewerbe',
                'location' => 'Basel',
                'title' => 'Maurer / Maurerin EFZ',
                'description' => 'Du fÃ¼hrst Mauerarbeiten, Betonarbeiten und Abbrucharbeiten auf verschiedenen Baustellen in der Region Basel aus. Du arbeitest im Team, hÃ¤ltst Sicherheitsvorschriften ein und gehst sorgfÃ¤ltig mit Materialien und Maschinen um. Abgeschlossene Berufsausbildung als Maurer EFZ und FÃ¼hrerausweis Kat. B sind Voraussetzung.',
                'home_office' => false,
                'workplace' => 'Onsite',
            ],
            [
                'company' => 'BuildMaster SA',
                'category' => 'Baugewerbe',
                'location' => 'Genf',
                'title' => 'Projektleiter Tiefbau (m/w/d)',
                'description' => 'Du planst und leitest Tiefbauprojekte (Strassen, Leitungen, Kanalisationen) von der Ausschreibung bis zur Abrechnung. Du fÃ¼hrst dein Team vor Ort, kommunizierst mit BehÃ¶rden und Auftraggebern und sorgst fÃ¼r die Einhaltung aller Sicherheits- und QualitÃ¤tsstandards.',
                'home_office' => false,
                'workplace' => 'Onsite',
            ],
            [
                'company' => 'TechNova AG',
                'category' => 'Finanzen',
                'location' => 'ZÃ¼rich',
                'title' => 'Finanzanalyst (m/w/d)',
                'description' => 'Du analysierst Finanz- und Businessdaten, erstellst Reports und Forecasts und unterstÃ¼tzt das Management bei strategischen Entscheidungen. Du arbeitest mit ERP-Systemen und BI-Tools, entwickelst Finanzmodelle in Excel und prÃ¤sentierst Ergebnisse verstÃ¤ndlich an verschiedene Stakeholder.',
                'home_office' => true,
                'workplace' => 'Hybrid',
            ],
            [
                'company' => 'Helvetic IT Solutions',
                'category' => 'Finanzen',
                'location' => 'Bern',
                'title' => 'Buchhalter / Buchhalterin (m/w/d)',
                'description' => 'Du fÃ¼hrst die Finanzbuchhaltung inklusive Debitoren, Kreditoren und Hauptbuch. Du erstellst Monats- und JahresabschlÃ¼sse nach OR, wickelst den Zahlungsverkehr ab und bist Ansprechperson fÃ¼r Steuerberater und Revisoren. Kenntnisse in Abacus oder SAP sind von Vorteil.',
                'home_office' => false,
                'workplace' => 'Onsite',
            ],
            [
                'company' => 'TechNova AG',
                'category' => 'Finanzen',
                'location' => 'Basel',
                'title' => 'Steuerberater / Steuerberaterin (m/w/d)',
                'description' => 'Du berÃ¤tst unsere Klienten in allen Fragen des nationalen und internationalen Steuerrechts. Du erstellst SteuererklÃ¤rungen fÃ¼r natÃ¼rliche und juristische Personen, begleitest SteuerprÃ¼fungen und entwickelst steueroptimierte LÃ¶sungen. Ein Abschluss als diplomierter Steuerexperte oder vergleichbare Qualifikation wird vorausgesetzt.',
                'home_office' => true,
                'workplace' => 'Hybrid',
            ],
            [
                'company' => 'GreenEnergy Group',
                'category' => 'Gesundheit',
                'location' => 'Sion',
                'title' => 'Pflegefachfrau / Pflegefachmann (m/w/d)',
                'description' => 'Du pflegst und betreust Patientinnen und Patienten in unserem Pflegezentrum im Wallis. Du fÃ¼hrst pflegerische Massnahmen durch, dokumentierst den Pflegeverlauf und arbeitest eng mit dem interdisziplinÃ¤ren Team zusammen. Abschluss als dipl. Pflegefachperson HF oder FH sowie Sprachkenntnisse Deutsch/FranzÃ¶sisch erforderlich.',
                'home_office' => false,
                'workplace' => 'Onsite',
            ],
            [
                'company' => 'GreenEnergy Group',
                'category' => 'Gesundheit',
                'location' => 'Lugano',
                'title' => 'Medizinische Praxisassistentin (m/w/d)',
                'description' => 'Du empfÃ¤ngst Patienten, koordinierst Termine, assistierst bei medizinischen Untersuchungen und pflegst die Patientendossiers. Du bist erste Ansprechperson am Empfang und am Telefon und sorgst fÃ¼r einen reibungslosen Praxisablauf. MPA-Diplom und Italiano-Kenntnisse sind erforderlich.',
                'home_office' => false,
                'workplace' => 'Onsite',
            ],
            [
                'company' => 'GreenEnergy Group',
                'category' => 'Gesundheit',
                'location' => 'Bern',
                'title' => 'Fachperson Gesundheit (FaGe) (m/w/d)',
                'description' => 'Du unterstÃ¼tzt das Pflegeteam bei der Betreuung und Pflege von betagten Menschen in unserem Alters- und Pflegeheim. Du hilfst bei der KÃ¶rperpflege, der Mobilisation und den Mahlzeiten, dokumentierst deine TÃ¤tigkeiten und nimmst an Teambesprechungen teil. EFZ als Fachperson Gesundheit wird vorausgesetzt.',
                'home_office' => false,
                'workplace' => 'Onsite',
            ],
            [
                'company' => 'BuildMaster SA',
                'category' => 'Logistik',
                'location' => 'Basel',
                'title' => 'Lagerlogistiker / Lagerlogistikerin EFZ',
                'description' => 'Du nimmst Waren an, prÃ¼fst die Lieferscheine, lagerst GÃ¼ter fachgerecht ein und kommissionierst Bestellungen. Du bedienst FlurfÃ¶rderzeuge, fÃ¼hrst Inventuren durch und pflegst die Lagerverwaltungssoftware. EFZ als Lagerlogistiker und Staplerschein sind Voraussetzung.',
                'home_office' => false,
                'workplace' => 'Onsite',
            ],
            [
                'company' => 'Helvetic IT Solutions',
                'category' => 'Logistik',
                'location' => 'ZÃ¼rich',
                'title' => 'Speditionskauffrau / Speditionskaufmann (m/w/d)',
                'description' => 'Du organisierst nationale und internationale Transporte, erstellst Frachtdokumente, koordinierst Zollabfertigungen und bist Ansprechperson fÃ¼r Kunden und Spediteure. Du Ã¼berwachst SendungsverlÃ¤ufe, optimierst Prozesse und arbeitest eng mit dem Einkauf zusammen.',
                'home_office' => true,
                'workplace' => 'Hybrid',
            ],
            [
                'company' => 'BuildMaster SA',
                'category' => 'Logistik',
                'location' => 'Lugano',
                'title' => 'EinkÃ¤ufer / EinkÃ¤uferin Logistik (m/w/d)',
                'description' => 'Du beschaffst Materialien, VerbrauchsgÃ¼ter und Dienstleistungen fÃ¼r unsere Bauprojekte im Tessin. Du verhandelst Konditionen mit Lieferanten, Ã¼berwachst Liefertermine und optimierst die Beschaffungskosten. Erfahrung im Bau-Einkauf und Kenntnisse in Italiano sowie Deutsch sind erforderlich.',
                'home_office' => false,
                'workplace' => 'Onsite',
            ],
        ];

        foreach ($jobs as $data) {
            $meta = $locationMeta[$data['location']];
            $contact = $companyContact[$data['company']];

            Job::query()->updateOrCreate([
                'title' => $data['title'],
            ], [
                'company_id' => $companies[$data['company']]->id,
                'category_id' => $categories[$data['category']]->id,
                'location_id' => $locations[$data['location']]->id,
                'description' => $data['description'],
                'canton' => $meta['canton'],
                'zip' => $meta['zip'],
                'home_office' => $data['home_office'],
                'language' => $meta['language'],
                'workplace' => $data['workplace'],
                'email' => $contact['email'],
                'phone' => $contact['phone'],
            ]);
        }

        Job::query()->updateOrCreate([
            'title' => 'PHP Developer',
        ], [
            'company_id' => $companies->first()->id,
            'category_id' => $categories['Informatik']->id ?? $categories->first()->id,
            'location_id' => $locations['ZÃ¼rich']->id ?? $locations->first()->id,
            'description' => 'Wir suchen eine PHP Developer Person fuer unseren einfachen Bewerbungs-Flow.',
            'canton' => 'ZH',
            'zip' => '8001',
            'home_office' => true,
            'language' => 'Deutsch',
            'workplace' => 'Hybrid',
            'email' => $companyContact[$companies->first()->company_name]['email'] ?? $companies->first()->email,
            'phone' => $companyContact[$companies->first()->company_name]['phone'] ?? null,
        ]);
    }
}
