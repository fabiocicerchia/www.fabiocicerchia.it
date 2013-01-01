/**
 * FABIO CICERCHIA - WEBSITE
 *
 * Copyright 2012 - 2013 Fabio Cicerchia. All rights reserved.
 *
 * Permission is hereby granted, free of  charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction,  including without limitation the rights
 * to use,  copy, modify,  merge, publish,  distribute, sublicense,  and/or sell
 * copies  of the  Software,  and to  permit  persons to  whom  the Software  is
 * furnished to do so, subject to the following conditions:
 *
 * The above  copyright notice and this  permission notice shall be  included in
 * all copies or substantial portions of the Software.
 *
 * The data  inside this  file MUST  be changed with  your own  information, you
 * aren't allowed to use, copy,  modify, merge, publish, distribute, sublicense,
 * and/or sell this file as is.
 *
 * THE SOFTWARE  IS PROVIDED "AS IS",  WITHOUT WARRANTY OF ANY  KIND, EXPRESS OR
 * IMPLIED,  INCLUDING BUT  NOT LIMITED  TO THE  WARRANTIES OF  MERCHANTABILITY,
 * FITNESS FOR A  PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO  EVENT SHALL THE
 * AUTHORS  OR COPYRIGHT  HOLDERS  BE LIABLE  FOR ANY  CLAIM,  DAMAGES OR  OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

/* ========================================================================== */
/* ================================ INDEXES ================================= */
/* ========================================================================== */

/* education indexes */
db.getCollection("education").ensureIndex({"_id": 1}, []);

/* experience indexes */
db.getCollection("experience").ensureIndex({"_id": 1}, []);

/* information indexes */
db.getCollection("information").ensureIndex({"_id": 1}, []);

/* language indexes */
db.getCollection("language").ensureIndex({"_id": 1}, []);

/* skill indexes */
db.getCollection("skill").ensureIndex({"_id": 1}, []);

/* ========================================================================== */
/* =============================== EDUCATION ================================ */
/* ========================================================================== */

/* Last Update: 2012-11-09 */
db.getCollection("education").insert({
    "_id": ObjectId("e10c9eaad293c7ca80fcca92"), /* ID: BSC-PIE-LON-2012 */
    "activities": {
        "en_GB": [
            "Grammar",
            "Vocabulary",
            "Reading",
            "Writing",
            "Pronunciation",
            "Speaking",
            "Listening"
        ],
        "it_IT": [
            "Grammatica",
            "Vocabolario",
            "Lettura",
            "Scrittura",
            "Pronuncia",
            "Produzione Orale",
            "Ascolto"
        ]
    },
    "date": {
        "start": ISODate("2012-04-02T00:00:00"),
        "end":   ISODate("2012-04-27T00:00:00"),
        "hours": 80
    },
    "institute": {
        "_id": ObjectId("0c5349fbc948c9d10864dd59"), /* ID: BCS-LON */
        "location": {
            "address": "Hannah House, 13-16 Manchester Street",
            "city": {
                "en_GB": "London",
                "it_IT": "Londra"
            },
            "country": {
                "en_GB": "United Kingdom",
                "it_IT": "Regno Unito"
            },
            "postal_code": "W1U 4DJ"
        },
        "name": "British Study Centre",
        "url":  "http:\/\/www.british-study.com"
    },
    "title": {
        "en_GB": "Pre-Intermediate English",
        "it_IT": "Inglese Pre-Intermedio"
    }
});

/* Last Update: 2012-11-09 */
db.getCollection("education").insert({
    "_id": ObjectId("dea25ca1ffe2160219a0f965"), /* ID: IWA-CWPAD-ND-2011 */
    "activities": {
        "en_GB": [
            "CIW Associate",
            "CIW Application Developer",
            "At least 2 years of work experience"
        ],
        "it_IT": [
            "CIW Associate",
            "CIW Application Developer",
            "Almeno 2 anni di esperienza lavorativa"
        ]
    },
    "date": {
        "start": ISODate("2011-04-27T00:00:00"),
        "end":   ISODate("2011-04-27T00:00:00")
    },
    "institute": {
        "_id":  ObjectId("252f53aa41c5148d9335c6da"), /* ID: IWA-ND */
        "name": "IWA",
        "url":  "http:\/\/www.iwanet.org"
    },
    "title": {
        "en_GB": "Certified Web Professional Application Developer",
        "it_IT": "Certified Web Professional Application Developer"
    }
});

/* Last Update: 2012-11-09 */
db.getCollection("education").insert({
    "_id": ObjectId("fc7a2c4a3adc210e9f6098b3"), /* ID: PTCFIS-CIAWD-ROM-2011 */
    "activities": {
        "en_GB": [
            "Fundamentals of CGI Using Perl",
            "Dynamic Server Pages (ASP.net, PHP)"
        ],
        "it_IT": [
            "Fondamenti di CGI utilizzando Perl",
            "Dynamic Server Pages (ASP.net, PHP)"
        ]
    },
    "date": {
        "start": ISODate("2011-02-08T00:00:00"),
        "end":   ISODate("2011-02-08T00:00:00")
    },
    "institute": {
        "_id": ObjectId("ce53a6ffffe70cdc825612b8"), /* ID: PTCFT-ROM */
        "location": {
            "address": "Via dei Gracchi, 209",
            "city": {
                "en_GB": "Rome",
                "it_IT": "Roma"
            },
            "country": {
                "en_GB": "Italy",
                "it_IT": "Italia"
            },
            "postal_code": "00192"
        },
        "name": "Prometric Test Center \"Finsa Tech S.r.l.\""
    },
    "title": {
        "en_GB": "CIW Application Developer",
        "it_IT": "CIW Application Developer"
    }
});

/* Last Update: 2012-11-09 */
db.getCollection("education").insert({
    "_id": ObjectId("3a6358b413cece519251ef6d"), /* ID: PTCAS-CIWA-ROM-2009 */
    "activities": {
        "en_GB": [
            "Internet Business Foundation",
            "Site Development Foundation",
            "Network Technology Foundation"
        ],
        "it_IT": [
            "Fondamenti di Business Internet",
            "Fondamenti di Sviluppo Siti",
            "Fondamenti di Tecnologie di Rete"
        ]
    },
    "date": {
        "start": ISODate("2009-09-23T00:00:00"),
        "end":   ISODate("2009-09-23T00:00:00")
    },
    "institute": {
        "_id": ObjectId("b75ade749ca9315b9f86b92a"), /* ID: PTCAS-ROM */
        "location": {
            "address": "Via Valentino Mazzola, 66",
            "city": {
                "en_GB": "Rome",
                "it_IT": "Roma"
            },
            "country": {
                "en_GB": "Italy",
                "it_IT": "Italia"
            },
            "postal_code": "00142"
        },
        "name": "Prometric Test Center \"Atrak S.r.l.\""
    },
    "title": {
        "en_GB": "CIW Associate",
        "it_IT": "Associato CIW"
    }
});

/* Last Update: 2012-11-09 */
db.getCollection("education").insert({
    "_id": ObjectId("c808b688a1fbf0429894bf1e"), /* ID: PVATCICC-ZCE-ROM-2008 */
    "activities": {
        "en_GB": [
            "PHP Basics",
            "Functions",
            "Arrays",
            "Object Oriented Programming",
            "Security",
            "XML and Web Services",
            "Strings and Patterns",
            "Database and SQL",
            "User Interaction (Form, Session, Cookie, HTTP Header)",
            "Stream and Files",
            "PHP 4 and PHP 5 Differences",
            "Theory and Design"
        ],
        "it_IT": [
            "Basi di PHP",
            "Funzioni",
            "Array",
            "Programmazione Orientata agli Oggetti",
            "Sicurezza",
            "XML e Web Services",
            "Stringhe e Patterns",
            "Database e SQL",
            "Interazione Utente (Form, Sessioni, Cookie, HTTP Header)",
            "Flussi e Files",
            "Differenze tra PHP 4 e PHP 5",
            "Teoria e Progettazione"
        ]
    },
    "date": {
        "start": ISODate("2008-06-25T00:00:00"),
        "end":   ISODate("2008-06-25T00:00:00")
    },
    "institute": {
        "_id": ObjectId("381583daea4f1d49266fabfa"), /* ID: PVATCICC-ROM */
        "location": {
            "address": "Via Antonio Pisano, 9",
            "city": {
                "en_GB": "Rome",
                "it_IT": "Roma"
            },
            "country": {
                "en_GB": "Italy",
                "it_IT": "Italia"
            },
            "postal_code": "00142"
        },
        "name": "Pearson Vue Authorised Test Center \"IPSIA Carlo Cattaneo\""
    },
    "title": {
        "en_GB": "Zend Certified Engineer",
        "it_IT": "Ingegnere Certificato Zend"
    }
});

/* Last Update: 2012-11-09 */
db.getCollection("education").insert({
    "_id": ObjectId("0bc6a84ca08a2c61b2bd122c"), /* ID: A-EC-GUI-2005 */
    "activities": {
        "en_GB": [
            "Basic concepts of Information Technology",
            "Using the computer and managing files",
            "Word processing",
            "Spreadsheets",
            "Database",
            "Presentation",
            "Information and communication"
        ],
        "it_IT": [
            "Concetti di base della IT",
            "Uso del computer - Gestione files",
            "Elaborazione testi",
            "Foglio elettronico",
            "Database",
            "Presentazione",
            "Reti informatiche - Internet"
        ]
    },
    "date": {
        "start": ISODate("2005-10-24T00:00:00"),
        "end":   ISODate("2005-12-19T00:00:00"),
        "hours": 5
    },
    "institute": {
        "_id": ObjectId("aefa1aa0abac59b9014cf1aa"), /* ID: A-GUI */
        "location": {
            "city": {
                "en_GB": "Guidonia Montecelio",
                "it_IT": "Guidonia Montecelio"
            },
            "country": {
                "en_GB": "Italy",
                "it_IT": "Italia"
            },
            "postal_code": "00012"
        },
        "name": "AICA",
        "url":  "http:\/\/www.aicanet.it"
    },
    "title": {
        "en_GB": "ECDL Core",
        "it_IT": "ECDL Core"
    }
});

/* Last Update: 2012-11-09 */
db.getCollection("education").insert({
    "_id": ObjectId("04ecd4546359edc110933d1e"), /* ID: IEF-IETCSSPA-FRA-2005 */
    "activities": {
        "en_GB": [
            "Italian language and literature",
            "History",
            "Foreign language (English)",
            "Law and Economics",
            "Geography",
            "Mathematics",
            "Earth Sciences",
            "Biology",
            "Physics and laboratory",
            "Chemistry and laboratory",
            "Technology and Drawing",
            "Calculus of probability, Statistics, Operative Research",
            "Electronics",
            "Generic Computer Science",
            "Computing systems and elaboration's transmission",
            "Physical Education"
        ],
        "it_IT": [
            "Lingua e Lettere Italiane",
            "Storia",
            "Lingua straniera (Inglese)",
            "Diritto ed Economia",
            "Geografia",
            "Matematica",
            "Scienze della Terra",
            "Biologia",
            "Fisica e laboratorio",
            "Chimica e laboratorio",
            "Tecnologia e disegno",
            "Calcolo delle probabilita, Statistica, Ricerca Operativa",
            "Elettronica",
            "Informatica Generale",
            "Sistemi di elaborazione e trasmissione dell'elaborazione",
            "Educazione Fisica"
        ]
    },
    "date": {
        "start": ISODate("2000-09-04T00:00:00"),
        "end":   ISODate("2005-07-05T00:00:00"),
        "hours": 5676
    },
    "institute": {
        "_id": ObjectId("c59a1c6e87fe2c3db58cb624"), /* ID: IEF-FRA */
        "location": {
            "address": "Via Cesare Minardi, 14",
            "city": {
                "en_GB": "Frascati",
                "it_IT": "Frascati"
            },
            "country": {
                "en_GB": "Italy",
                "it_IT": "Italia"
            },
            "postal_code": "00044"
        },
        "name": "ITIS Enrico Fermi",
        "url":  "http:\/\/www.fermifrascati.it\/"
    },
    "title": {
        "en_GB": "Industrial Expert Technician - Computer Science Specialization Project \"ABACUS\"",
        "it_IT": "Perito Industriale Capo Tecnico Specializzazione: Informatica \"Abacus\""
    }
});

/* ========================================================================== */
/* ============================== EXPERIENCE ================================ */
/* ========================================================================== */

/* Last Update: 2012-12-31 */
db.getCollection("experience").insert({
    "_id": ObjectId("8ae7278a4d60c5f2195f2bec"), /* ID: FPL-LPD-LON-2012 */
    "date": {
        "start": ISODate("2012-04-30T00:00:00"),
        "end": -1
    },
    "company": {
        "_id": ObjectId("d4cc240f5d56db02608e5bfe"), /* ID: FPL-LON */
        "location": {
            "address": "Lower Ground Floor, 20-23 Greville Street",
            "city": {
                "en_GB": "London",
                "it_IT": "Londra"
            },
            "country": {
                "en_GB": "United Kingdom",
                "it_IT": "Regno Unito"
            },
            "postal_code": "EC1N 8SS"
        },
        "name": "FusePump Limited",
        "url": "http:\/\/www.fusepump.com"
    },
    "role": {
        "en_GB": "LAMP \/ PHP Developer",
        "it_IT": "Sviluppatore LAMP \/ PHP"
    },
    "techniques": {
        "Code Coverage":                 {"months": 6},
        "Defensive Programming":         {"months": 6},
        "Functional Testing":            {"months": 6},
        "Pair Programming":              {"months": 5},
        "Profiling":                     {"months": 4},
        "Static Code Analysis":          {"months": 6},
        "Unit Testing":                  {"months": 6},
        "User Stories & Planning Poker": {"months": 3}
    },
    "technologies": {
        "Apache":     {"months": 7},
        "AWS":        {"months": 1},
        "Bash Shell": {"months": 7},
        "JavaScript": {"months": 4},
        "JSON-RPC":   {"months": 3},
        "MongoDB":    {"months": 6},
        "MySQL":      {"months": 4},
        "PHP":        {"months": 7},
        "Redis":      {"months": 6},
        "REST":       {"months": 4},
        "XML":        {"months": 7}
    },
    "tools": {
        "ApiGen":          {"months": 5},
        "gedit":           {"months": 7},
        "GreenHopper":     {"months": 3},
        "Jira":            {"months": 7},
        "NetBeans":        {"months": 7},
        "PHP_CodeSniffer": {"months": 5},
        "phpDocumentor 2": {"months": 6},
        "PHPUnit":         {"months": 6},
        "Sublime Text":    {"months": 5},
        "SVN":             {"months": 7},
        "vim":             {"months": 7},
        "Zend Framework":  {"months": 7}
    }
});

/* Last Update: 2012-11-09 */
db.getCollection("experience").insert({
    "_id": ObjectId("2c8b8de08a22e2f3f1a36877"), /* ID: FC-C-PAL-2003 */
    "date": {
        "start": ISODate("2003-05-01T00:00:00"),
        "end":   -1
    },
    "description": {
        "en_GB": "Web sites development and implementation (showcase sites and custom web applications).\nFrom June 2006 development and project management of Bonzai (planning, design, development and maintaining).\nFrom August 2005 collaboration with the Art Director Jeroen Bertsch. Development of showcase sites with Wordpress and customized systems.",
        "it_IT": "Sviluppo e realizzazione siti web (siti vetrina e applicazioni web personalizzate).\nDa Giugno 2006 sviluppo e gestione del progetto Bonzai ( pianificazione, progettazione, sviluppo e manutenzione).\nDa Agosto 2005 collaborazione con l'Art Director Jeroen Bertsch. Realizzazione di siti vetrina con Wordpress e con sistemi ad-hoc."
    },
    "company": {
        "_id": ObjectId("e8c08925e56d318eb854b22f"), /* ID: FC-PAL */
        "address": {
            "city": {
                "en_GB": "Palestrina",
                "it_IT": "Palestrina"
            },
            "country": {
                "en_GB": "Italy",
                "it_IT": "Italia"
            },
            "postal_code": "00036"
        },
        "name": "Fabio Cicerchia"
    },
    "projects": [
        {
            "_id": ObjectId("bb07b56c6ed5f6b0c092d886"), /* ID: PRJCT-PW-2012 */
            "date": {
                "start": ISODate("2012-02-01T00:00:00"),
                "end":   -1
            },
            "description": {
                "en_GB": "My own website, nothing serious or enterprise, just to show what I know, what I learned and how I do it. It's not a big project neither is perfect (nor completed).",
                "it_IT": "Il mio sito web, niente di serio o enterprise, giusto per dimostrare quello che so, quello che ho imparato e il modo in cui lo faccio. Non è un grande progetto e non &egrave; perfetto (tantomeno ultimato)."
            },
            "name": "Personal Website",
            "role": {
                "en_GB": "Lead Web Developer",
                "it_IT": "Lead Web Developer"
            },
            "techniques": {
                "Code Coverage":          {"months": 4},
                "Continuous Integration": {"months": 3},
                "Defensive Programming":  {"months": 5},
                "DRY":                    {"months": 5},
                "Functional Testing":     {"months": 4},
                "KISS":                   {"months": 5},
                "PEP8":                   {"months": 2},
                "Perl Best Practices":    {"months": 2},
                "PSR-2":                  {"months": 3},
                "Unit Testing":           {"months": 5},
                "YAGNI":                  {"months": 5}
            },
            "technologies": {
                "Apache":               {"months": 5},
                "Atom Syndication":     {"months": 2},
                "Bash Shell":           {"months": 5},
                "CSS 3":                {"months": 3},
                "Dublin Core Metadata": {"months": 2},
                "HTML 5":               {"months": 3},
                "Microdata":            {"months": 3},
                "Microformat":          {"months": 3},
                "MongoDB":              {"months": 4},
                "Perl":                 {"months": 3},
                "PHP":                  {"months": 4},
                "Python":               {"months": 3},
                "REST":                 {"months": 3},
                "RSS":                  {"months": 1},
                "Sitemaps XML":         {"months": 1},
                "vCard":                {"months": 1}
            },
            "tools": {
                "Capistrano":            {"months": 2},
                "CPAN Minus":            {"months": 2},
                "Devel::Cover":          {"months": 2},
                "epydoc":                {"months": 2},
                "gedit":                 {"months": 5},
                "Git Extras":            {"months": 3},
                "Git Flow":              {"months": 3},
                "Git":                   {"months": 5},
                "Google Minify":         {"months": 2},
                "nikto":                 {"months": 2},
                "OWASP - Core Rule Set": {"months": 2},
                "pep8":                  {"months": 2},
                "Perl::Critic":          {"months": 2},
                "perltidy":              {"months": 2},
                "PHP_CodeBrowser":       {"months": 4},
                "PHP_CodeCoverage":      {"months": 4},
                "PHP_CodeSniffer":       {"months": 4},
                "phpcov":                {"months": 4},
                "phpcpd":                {"months": 4},
                "PHP-CS-Fixer":          {"months": 4},
                "PHP Depend":            {"months": 4},
                "phpDocumentor 2":       {"months": 4},
                "phploc":                {"months": 4},
                "PHP Mess Detector":     {"months": 4},
                "PHPUnit":               {"months": 4},
                "Poedit":                {"months": 2},
                "pylint":                {"months": 2},
                "Silex-Extension":       {"months": 4},
                "Silex":                 {"months": 4},
                "Sublime Text":          {"months": 5},
                "Template Toolkit":      {"months": 3},
                "Test::More":            {"months": 3},
                "TravisCI":              {"months": 3},
                "Twitter Bootstrap":     {"months": 3},
                "vim":                   {"months": 5}
            },
            "url":  "http:\/\/www.fabiocicerchia.it"
        },
        {
            "_id": ObjectId("c8e506c872f0a5cfd98c24f9"), /* ID: PRJCT-B-2006 */
            "activities": {
                "en_GB": [
                    "Feature Development and Code Maintenance",
                    "Website Maintenance, repository PEAR",
                    "Documentation"
                ],
                "it_IT": [
                    "Implementazione feature e Manutenzione del codice",
                    "Manutenzione sito web, repository PEAR",
                    "Documentazione"
                ]
            },
            "name": "Bonzai",
            "date": {
                "start": ISODate("2006-08-22T00:00:00"),
                "end":   -1
            },
            "description": {
                "en_GB": "My own project that convert plain PHP sources to PHP compiled bytecode (through bcompiler extension).",
                "it_IT": "Il mio progetto personale che trasforma i sorgenti PHP in bytecode (attraverso l'estensione bcompiler)."
            },
            "role": {
                "en_GB": "Lead Web & Software Developer",
                "it_IT": "Lead Web & Software Developer"
            },
            "techniques": {
                "Code Coverage":          {"months": 4},
                "Continuous Integration": {"months": 2},
                "Unit Testing":           {"months": 5}
            },
            "technologies": {
                "Apache":       {"months": 12},
                "Bash Shell":   {"months": 24},
                "C":            {"months": 8},
                "CSS":          {"months": 5},
                "MySQL":        {"months": 4},
                "PHP":          {"months": 24},
                "Sitemaps XML": {"months": 1},
                "XHTML":        {"months": 5}
            },
            "tools": {
                "Automake":          {"months": 6},
                "cUnit":             {"months": 8},
                "CVS":               {"months": 4},
                "DDD":               {"months": 8},
                "DocBlox":           {"months": 10},
                "DokuWiki":          {"months": 6},
                "Doxygen":           {"months": 12},
                "Flyspray":          {"months": 6},
                "GDB":               {"months": 8},
                "gedit":             {"months": 24},
                "Git":               {"months": 12},
                "phpBB":             {"months": 6},
                "PHP_CodeBrowser":   {"months": 12},
                "PHP_CodeCoverage":  {"months": 12},
                "PHP_CodeSniffer":   {"months": 12},
                "phpcov":            {"months": 12},
                "phpcpd":            {"months": 12},
                "PHP Depend":        {"months": 12},
                "phpDocumentor":     {"months": 8},
                "phploc":            {"months": 12},
                "PHP Mess Detector": {"months": 12},
                "phpt":              {"months": 8},
                "PHPUnit":           {"months": 12},
                "pirum":             {"months": 3},
                "Splint":            {"months": 6},
                "TravisCI":          {"months": 2},
                "Valgrind":          {"months": 6},
                "vim":               {"months": 12}
            },
            "url": "http:\/\/www.bonzai-project.org"
        }
    ],
    "role": {
        "en_GB": "Consultant",
        "it_IT": "Consulente"
    },
    "techniques": {
        "Automated Builds":       {"months": 12},
        "Code Coverage":          {"months": 12},
        "Continuous Integration": {"months": 6},
        "Functional Testing":     {"months": 24},
        "Pomodoro Technique":     {"months": 12},
        "Profiling":              {"months": 12},
        "Static Code Analysis":   {"months": 24},
        "Unit Testing":           {"months": 24}
    },
    "technologies": {
        "Apache":       {"months": 48},
        "Bash Shell":   {"months": 48},
        "CSS 3":        {"months": 12},
        "CSS":          {"months": 60},
        "HTML 5":       {"months": 6},
        "HTML":         {"months": 24},
        "JavaScript":   {"months": 48},
        "MySQL":        {"months": 48},
        "PHP":          {"months": 48},
        "Sitemaps XML": {"months": 12},
        "SQLite":       {"months": 12},
        "XHTML":        {"months": 48}
    },
    "tools": {
        "Firebug":          {"months": 30},
        "gedit":            {"months": 24},
        "Git":              {"months": 6},
        "Google Minify":    {"months": 24},
        "Jenkins":          {"months": 4},
        "Joomla":           {"months": 12},
        "jQuery":           {"months": 36},
        "Mantis":           {"months": 2},
        "Google PageSpeed": {"months": 24},
        "PHP_CodeSniffer":  {"months": 30},
        "phpDocumentor":    {"months": 36},
        "PHPUnit":          {"months": 6},
        "Prototype":        {"months": 12},
        "Selenium":         {"months": 5},
        "Silex":            {"months": 6},
        "Sonar":            {"months": 2},
        "Symfony":          {"months": 6},
        "vim":              {"months": 48},
        "Wordpress":        {"months": 36},
        "YSlow":            {"months": 30},
        "Zend Framework":   {"months": 12}
    }
});

/* Last Update: 2012-11-09 */
db.getCollection("experience").insert({
    "_id": ObjectId("6eb43a5716f87b4f756dfbbc"), /* ID: DITS-PD-ROM-2010 */
    "company": {
        "_id": ObjectId("c29179ca15ee6a2eae206446"), /* ID: DITS-ROM */
        "location": {
            "address":     "Via Flaminia Vecchia, 495",
            "city": {
                "en_GB": "Rome",
                "it_IT": "Roma"
            },
            "country": {
                "en_GB": "Italy",
                "it_IT": "Italia"
            },
            "postal_code": "00191"
        },
        "name": "Dnsee (Interactive Thinking S.r.l.)",
        "url":  "http:\/\/www.dnsee.com"
    },
    "date": {
        "start": ISODate("2010-06-21T00:00:00"),
        "end":   ISODate("2012-03-30T00:00:00")
    },
    "projects": [
        {
            "_id": ObjectId("807e53cd2d281aa56b01025a"), /* ID: PRJCT-SGS-2010 */
            "date": {
                "start": ISODate("2010-06-21T00:00:00"),
                "end":   ISODate("2010-10-01T00:00:00")
            },
            "description": {
                "en_GB": "Development of a mini website for Samsung for the Samsung Galaxy S launch",
                "it_IT": "Sviluppo di un minisito per Samsung per il lancio del Samsung Galaxy S"
            },
            "role": {
                "en_GB": "Web Developer",
                "it_IT": "Sviluppatore Web"
            },
            "name": "Samsung Galaxy S",
            "technologies": {
                "Apache":     {"months": 2},
                "Bash Shell": {"months": 1},
                "CSS":        {"months": 2},
                "MySQL":      {"months": 2},
                "PHP":        {"months": 2},
                "XHTML":      {"months": 2}
            },
            "tools": {
                "Hudson":        {"months": 2},
                "Jira":          {"months": 2},
                "phpDocumentor": {"months": 2},
                "SVN":           {"months": 2},
                "Symfony":       {"months": 2},
                "vim":           {"months": 2}
            }
        },
        {
            "_id": ObjectId("9f47b9a909bfa9fe1843c4a5"), /* ID: PRJCT-PCBOR-2010 */
            "date": {
                "start": ISODate("2010-07-28T00:00:00"),
                "end":   ISODate("2011-02-01T00:00:00")
            },
            "description": {
                "en_GB": "Integration into Joomla CMS some custom features like photo and video gallery, custom search to find doctors and appointments with the possibility to book or cancel them, integration and aggregation of clinical departments retrieved by an external service.",
                "it_IT": "Integrazione in Joomla CMS di alcune funzioni personalizzate, come foto e video gallery, ricerca personalizzata per trovare medici e appuntamenti con la possibilit&agrave; di prenotare o cancellare, integrazione e aggregazione di reparti clinici recuperati da un servizio esterno."
            },
            "name": "Policlinic Campus Biomedical of Rome",
            "role": {
                "en_GB": "Web Developer",
                "it_IT": "Web Developer"
            },
            "technologies": {
                "Apache":     {"months": 6},
                "Bash Shell": {"months": 2},
                "CSS":        {"months": 3},
                "JavaScript": {"months": 3},
                "MySQL":      {"months": 6},
                "Oracle":     {"months": 2},
                "PHP":        {"months": 6},
                "SQL Server": {"months": 2},
                "XHTML":      {"months": 4}
            },
            "tools": {
                "gedit":         {"months": 2},
                "Jira":          {"months": 6},
                "Joomla":        {"months": 4},
                "jQuery":        {"months": 3},
                "phpDocumentor": {"months": 3},
                "SVN":           {"months": 6},
                "vim":           {"months": 5}
            },
            "url":  "http:\/\/www.policlinicocampusbiomedico.it"
        },
        {
            "_id": ObjectId("ef5a168049c4c6fed89049eb"), /* ID: PRJCT-SR-2010 */
            "date": {
                "start": ISODate("2010-10-05T00:00:00"),
                "end":   ISODate("2012-03-30T00:00:00")
            },
            "description": {
                "en_GB": "Development and Project Management of a multilanguage web portal for a big italian healthcare company.\nThe portal ranging from a CMS to health structure management (which are composed of department) through some form of profiled user registration, booking, contact and form to ask question directly to doctors.\nThere are available also a supplier management system (registration, payment, confidential documents archive) and formation system to manage all the courses provided from internal and externals universities, with the possibility to book them.",
                "it_IT": "Sviluppo e Project Management di un portale web multilingue per una grande azienda sanitaria italiana.\nIl portale spazia da un CMS per la gestione delle strutture sanitarie (che si compongono di dipartimenti) attraverso varie form di registrazione di utenti profilati, form di prenotazione, contatti e modulo per fare domanda direttamente ai medici.\nSono a disposizione anche un sistema di gestione dei fornitori (registrazione, pagamento, archivio documenti riservati) ed un sistema di formazione per gestire tutti i corsi previsti da universit&agrave; interne ed esterne, con la possibilit&agrave; di prenotarli."
            },
            "methodologies": {
                "eXtreme Programming": {"months": 10},
                "SCRUM":               {"months": 7}
            },
            "name": "San Raffaele",
            "role": {
                "en_GB": "Lead Web Developer",
                "it_IT": "Lead Web Developer"
            },
            "techniques": {
                "Automated Builds":              {"months": 12},
                "Continuous Integration":        {"months": 12},
                "Functional Testing":            {"months": 15},
                "Pair Programming":              {"months": 12},
                "Pomodoro Technique":            {"months": 6},
                "Unit Testing":                  {"months": 15},
                "User Stories & Planning Poker": {"months": 15}
            },
            "technologies": {
                "Apache":       {"months": 15},
                "Bash Shell":   {"months": 5},
                "CSS":          {"months": 7},
                "JavaScript":   {"months": 15},
                "MySQL":        {"months": 15},
                "PHP":          {"months": 15},
                "Sitemaps XML": {"months": 2},
                "SQLite":       {"months": 10},
                "XHTML":        {"months": 7}
            },
            "tools": {
                "Alfresco":         {"months": 15},
                "Firebug":          {"months": 10},
                "gedit":            {"months": 5},
                "Google Minify":    {"months": 2},
                "Hudson":           {"months": 12},
                "Jira":             {"months": 15},
                "jQuery":           {"months": 15},
                "Google PageSpeed": {"months": 10},
                "phpDocumentor":    {"months": 15},
                "Selenium":         {"months": 3},
                "Sublime Text":     {"months": 5},
                "SVN":              {"months": 15},
                "Symfony":          {"months": 15},
                "vim":              {"months": 10},
                "YSlow":            {"months": 10}
            },
            "url":  "http:\/\/www.sanraffaele.it"
        }
    ],
    "role": {
        "en_GB": "PHP Developer",
        "it_IT": "Sviluppatore PHP"
    },
    "tools": {
        "capifony":  {"months": 5},
        "Jira":      {"months": 6},
        "Silex":     {"months": 6},
        "SVN":       {"months": 6},
        "Symfony":   {"months": 2},
        "Symfony 2": {"months": 2},
        "Wordpress": {"months": 6}
    }
});

/* Last Update: 2012-11-09 */
db.getCollection("experience").insert({
    "_id": ObjectId("80f5b107a043cfceb820e845"), /* ID: PSEGS-WD-ROM-2008 */
    "company": {
        "_id": ObjectId("45916b6e8cd140e95c0faa4a"), /* ID: PSEGS-ROM */
        "location": {
            "address": "Via Cristoforo Colombo, 112",
            "city": {
                "en_GB": "Rome",
                "it_IT": "Roma"
            },
            "country": {
                "en_GB": "Italy",
                "it_IT": "Italia"
            },
            "postal_code": "001947"
        },
        "name": "Populis S.r.l. (ex GoAdv S.r.l.)",
        "url":  "http:\/\/www.populis.com"
    },
    "date": {
        "start": ISODate("2008-01-02T00:00:00"),
        "end":   ISODate("2010-06-18T00:00:00")
    },
    "methodologies": {
        "Waterfall Model": {"months": 30}
    },
    "role": {
        "en_GB": "Web Developer",
        "it_IT": "Sviluppatore Web"
    },
    "techniques": {
        "Functional Testing": {"months": 24},
        "Pair Programming":   {"months": 30},
        "Unit Testing":       {"months": 24}
    },
    "technologies": {
        "Apache":     {"months": 20},
        "Bash Shell": {"months": 20},
        "CSS":        {"months": 30},
        "JavaScript": {"months": 30},
        "MySQL":      {"months": 30},
        "PHP":        {"months": 30},
        "PostgreSQL": {"months": 12},
        "Python":     {"months": 6},
        "XHTML":      {"months": 30}
    },
    "tools": {
        "CVS":            {"months": 30},
        "FastESP":        {"months": 6},
        "Google Minify":  {"months": 5},
        "Joomla":         {"months": 6},
        "jQuery":         {"months": 12},
        "phpDocumentor":  {"months": 10},
        "Prototype":      {"months": 12},
        "Selenium":       {"months": 6},
        "SVN":            {"months": 30},
        "vim":            {"months": 30},
        "Wordpress":      {"months": 18},
        "Zend Framework": {"months": 6}
    }
});

/* Last Update: 2012-11-09 */
db.getCollection("experience").insert({
    "_id": ObjectId("4756c61b6d7839c5d7d1f759"), /* ID: AS-WSD-ROM-2007 */
    "company": {
        "_id": ObjectId("aa63f99d334b24be273374ba"), /* ID: AS-ROM */
        "location": {
            "address": "Via Barnaba Tortolini, 5",
            "city": {
                "en_GB": "Rome",
                "it_IT": "Roma"
            },
            "country": {
                "en_GB": "Italy",
                "it_IT": "Italia"
            },
            "postal_code": "00197"
        },
        "name": "ADQ S.p.A."
    },
    "date": {
        "start": ISODate("2007-05-24T00:00:00"),
        "end":   ISODate("2007-12-31T00:00:00")
    },
    "description": {
        "en_GB": "Design and development of some web sites, applications web-based and desktop.",
        "it_IT": "Progettazione e sviluppo di alcuni siti web, applicazioni web-based e desktop."
    },
    "projects": [
        {
            "_id": ObjectId("19fe286a31b2fe8813479c05"), /* ID: PRJCT-SI-2007 */
            "date": {
                "start": ISODate("2007-05-24T00:00:00"),
                "end":   ISODate("2007-12-31T00:00:00")
            },
            "description": {
                "en_GB": "Maintenance and subsequent re-development of an e-commerce site that sold electronic and computer products.",
                "it_IT": "Manutenzione e successivo rifacimento di un sito e-commerce che vendeva prodotti di elettronica e computer."
            },
            "name": "StockInformatica",
            "role": {
                "en_GB": "Web & Software Developer",
                "it_IT": "Sviluppatore Web & Software"
            },
            "methodologies": {
                "Waterfall Model": {"months": 8}
            },
            "technologies": {
                "ASP":          {"months": 8},
                "CSS":          {"months": 8},
                "HTML":         {"months": 8},
                "IIS":          {"months": 5},
                "MySQL":        {"months": 8},
                "PHP":          {"months": 8},
                "Visual Basic": {"months": 4}
            },
            "tools": {
                "Notepad++":  {"months": 8},
                "osCommerce": {"months": 8}
            }
        },
        {
            "_id": ObjectId("c18d17faa5b747acdfeaad5e"), /* ID: PRJCT-IC-2007 */
            "date": {
                "start": ISODate("2007-05-24T00:00:00"),
                "end":   ISODate("2007-12-31T00:00:00")
            },
            "methodologies": {
                "Waterfall Model": {"months": 8}
            },
            "name": "ItalianCamper",
            "role": {
                "en_GB": "Web Developer",
                "it_IT": "Sviluppatore Web"
            },
            "technologies": {
                "CSS":   {"months": 8},
                "HTML":  {"months": 8},
                "IIS":   {"months": 5},
                "MySQL": {"months": 8},
                "PHP":   {"months": 8}
            },
            "tools": {
                "Notepad++": {"months": 8},
                "PHP-Nuke":  {"months": 8}
            }
        },
        {
            "_id": ObjectId("a7c228345b8410966fc4b6a0"), /* ID: PRJCT-NPZ-2007 */
            "date": {
                "start": ISODate("2007-08-30T00:00:00"),
                "end":   ISODate("2007-09-28T00:00:00")
            },
            "methodologies": {
                "Waterfall Model": {"months": 1}
            },
            "name": "NoPayZone",
            "role": {
                "en_GB": "Web & Software Developer",
                "it_IT": "Sviluppatore Web & Software"
            },
            "technologies": {
                "CSS":          {"months": 1},
                "HTML":         {"months": 1},
                "IIS":          {"months": 1},
                "MySQL":        {"months": 1},
                "PHP":          {"months": 1},
                "Visual Basic": {"months": 1}
            },
            "tools": {
                "Notepad++": {"months": 1},
                "Wordpress": {"months": 1}
            }
        },
        {
            "_id": ObjectId("0660814ace1b58efe5fa8447"), /* ID: PRJCT-CZ-2007 */
            "date": {
                "start": ISODate("2012-08-30T00:00:00"),
                "end":   ISODate("2012-09-28T00:00:00")
            },
            "methodologies": {
                "Waterfall Model": {"months": 1}
            },
            "name": "CoolZone",
            "role": {
                "en_GB": "Web Developer",
                "it_IT": "Sviluppatore Web"
            },
            "technologies": {
                "CSS":   {"months": 1},
                "HTML":  {"months": 1},
                "IIS":   {"months": 1},
                "MySQL": {"months": 1},
                "PHP":   {"months": 1}
            },
            "tools": {
                "Notepad++": {"months": 1}
            }
        }
    ],
    "role": {
        "en_GB": "Web \/ Software Developer",
        "it_IT": "Sviluppatore Web & Software"
    }
});

/* Last Update: 2012-11-09 */
db.getCollection("experience").insert({
    "_id": ObjectId("c20d05a63e7b923467a112b0"), /* ID: TIT-WD-PAL-2005 */
    "company": {
        "_id": ObjectId("431347454f426fa6e78ede81"), /* ID: TIT-PAL */
        "location": {
            "city": {
                "en_GB": "Palestrina",
                "it_IT": "Palestrina"
            },
            "country": {
                "en_GB": "Italy",
                "it_IT": "Italia"
            },
            "postal_code": "00036"
        },
        "name": "The Italian Touch"
    },
    "date": {
        "start": ISODate("2005-10-03T00:00:00"),
        "end":   ISODate("2006-10-02T00:00:00")
    },
    "role": {
        "en_GB": "Web Developer",
        "it_IT": "Sviluppatore Web"
    },
    "technologies": {
        "CSS":        {"months": 12},
        "HTML":       {"months": 12},
        "JavaScript": {"months": 12},
        "MySQL":      {"months": 12},
        "PHP":        {"months": 12}
    }
});

/* Last Update: 2012-11-09 */
db.getCollection("experience").insert({
    "_id": ObjectId("bd7f19d705af2c2ea025dbf9"), /* ID: SB-HSC-PAL-2004 */
    "company": {
        "_id": ObjectId("2846d639a263ccdaebcfeece"), /* ID: SB-PAL */
        "location": {
            "address":     "Via della Basilica Romana, 36",
            "city": {
                "en_GB": "Palestrina",
                "it_IT": "Palestrina"
            },
            "country": {
                "en_GB": "Italy",
                "it_IT": "Italia"
            },
            "postal_code": "00036"
        },
        "name": "Studio Bonito"
    },
    "date": {
        "start": ISODate("2004-05-01T00:00:00"),
        "end":   ISODate("2005-10-01T00:00:00")
    },
    "role": {
        "en_GB": "Hardware \/ Software Consultant",
        "it_IT": "Consulente Hardware \/ Software"
    }
});

/* ========================================================================== */
/* ============================== INFORMATION =============================== */
/* ========================================================================== */

/* Last Update: 2012-11-09 */
db.getCollection("information").insert({
    "_id": ObjectId("7b702deeeb898e24d412e123"), /* ID: INFRMTN */
    "birth_day": ISODate("1986-02-09T00:00:00"),
    "contacts": {
        "msn":   "fabio.cicerchia@live.it",
        "skype": "fabio.cicerchia",
        "email": "info@fabiocicerchia.it"
    },
    "focus_on": {
        "AWS":           "http://aws.amazon.com/",
        "Arduino":       "http://www.arduino.cc/",
        "Backbone":      "http://backbonejs.org/", /* Backbone.js */
        "Burp":          "http://portswigger.net/burp/",
        "Cacti":         "http://www.cacti.net/",
        "Catalyst":      "http://www.catalystframework.org/",
        "Dart":          "http://www.dartlang.org/",
        "Django":        "https://www.djangoproject.com/",
        "Doctrine 2":    "http://www.doctrine-project.org/",
        "Gearman":       "http://gearman.org/",
        "Hadoop":        "http://hadoop.apache.org/",
        "Haskell":       "http://www.haskell.org/haskellwiki/Haskell",
        "HeadJS":        "http://headjs.com/",
        "Hubot":         "http://hubot.github.com/",
        "Jackrabbit":    "http://jackrabbit.apache.org/",
        "Jasmine":       "http://pivotal.github.com/jasmine/",
        "Knockout":      "http://knockoutjs.com/",
        "LESS":          "http://lesscss.org/",
        "Lucene":        "http://lucene.apache.org/core/index.html",
        "Mocha":         "http://visionmedia.github.com/mocha/",
        "Node":          "http://nodejs.org/", /* Node.js */
        "PhoneGap":      "http://phonegap.com/",
        "Puppet":        "http://puppetlabs.com/",
        "Raspberry Pi":  "http://www.raspberrypi.org/",
        "SPDY":          "http://www.chromium.org/spdy",
        "Sass":          "http://sass-lang.com/",
        "Symfony 2":     "http://symfony.com/",
        "Watobo":        "http://sourceforge.net/apps/mediawiki/watobo/index.php?title=Main_Page",
        "Zed":           "https://www.owasp.org/index.php/OWASP_Zed_Attack_Proxy_Project",
        "ZooKeeper":     "http://zookeeper.apache.org/",
        "mod_pagespeed": "https://developers.google.com/speed/pagespeed/mod",
        "pyjs":          "http://pyjs.org/",
        "ØMQ":           "http://www.zeromq.org/"
    },
    "gender": {
        "en_GB": "male",
        "it_IT": "maschio",
    },
    "info": {
        "en_GB": "I'm a passionate <strong>Web Developer</strong>, I often work either on <em>frontend</em> and <em>backend</em>.\nFortunately I'm looking at any time for new challenges and trying to keep myself at the <strong>cutting edge</strong>. When isn't possible at work I always find the <em>time at home to study</em> new technologies and methodologies to apply the next day.\nSince the early 2000s I've been focused on the web development, and now almost totally involved with <strong>PHP</strong> and <strong>JS</strong> applications. I've certified myself as <em>PHP 5 Engineer</em> and <em>IWA Application Developer</em>.\nEvery my working day has a heavy sprinkle of shell-interaction during which I enjoy myself with <em>regular expressions</em> and <em>scripting</em>. But I'm not 100% of my time in front a black screen with green characters (even because they aren't), I don't dislike at all <strong>refactoring</strong>, <strong>code documentation</strong>, and <strong>testing</strong> that are anything but boring.\nI like also work in such different areas like <strong>SEO</strong>, <strong>Accessibility</strong> and <strong>Project Management</strong>.\nLately I've been involved in the learning of <em>MongoDB</em>, <em>Perl</em>, <em>Python</em>, <em>Redis</em>, <em>XPath</em>, <em>Zend Framework</em>. Some of them for fun, some others for work. The last year I was totally committed on a big project developed using the RAD framework <strong>Symfony</strong> (with <strong>Doctrine</strong>) and practices like automated tests. I've got experience about <strong>agile development</strong> because we implemented some of the agile techniques (<em>iteration planning</em>, <em>test-first</em>, <em>collective code ownership</em> and so on).\nI had the opportunity to put mind and hands directly on the project management, following several aspects of the project life-cycle.\nJust for passion, curiosity and interest I've created <strong>Bonzai</strong> (formerly known as phpGuardian), an open-source tool for encoding the PHP projects. That kept me involved over the years a lot on the study of the PHP Core, the writing of a custom extension in C and the source code analysis.",
        "it_IT": "Sono un <strong>Web Developer</strong> appassionato, mi capita spesso di lavorare sia sul <em>frontend</em> che sul <em>backend</em>.\n Fortunatamente sono in cerca in ogni momento di nuove sfide e sto cercando di <strong>tenermi all'avanguardia</strong>. Quando non &egrave; possibile al lavoro trovo sempre il tempo a casa per studiare nuove tecnologie e metodologie da applicare il giorno successivo. Dai primi anni 2000 sono stato concentrato sullo sviluppo web, e ora quasi totalmente impegnato con applicazioni <strong>PHP</strong> e <strong>JS</strong>. Mi sono certificato come <em>PHP 5 Engineer</em> e <em>IWA Application Developer</em>.\n Ogni mia giornata di lavoro ha una bella spruzzata di interazione con la shell durante la quala mi diverto con <em>espressioni regolari</em> e <em>scripting</em>. Ma non sono il 100% del mio tempo davanti a uno schermo nero con caratteri verdi (anche perch&egrave; non lo sono), non mi dispiace il <strong>refactoring</strong>, <strong>documentazione del codice</strong>, e le <strong>prove</strong> che sono tutt'altro che noiosi.\nMi piace anche lavorare in settori diversi, come <strong>SEO</strong>, <strong>Accessibilit&agrave;</strong> e <strong>Project Management</strong>.\nUltimamente sto stato impegnato nell'apprendimento di <em>MongoDB</em>, <em>Perl</em>, <em>Python</em>, <em>Redis</em>, <em>XPath</em>, <em>Zend Framework</em>. Alcuni di loro per divertimento, altri per il lavoro.\n L'anno scorso sono stato totalmente impegnato in un grande progetto sviluppato utilizzando il framework <strong>Symfony</strong> (con <strong>Doctrine</strong>) e pratiche come test automatizzati. Ho esperienza di <strong>sviluppo agile</strong> perch&egrave; abbiamo implementato alcune delle tecniche agili (<em>pianificazione dell'iterazione</em>, <em>test-first</em>, <em>propriet&agrave; collettiva del codice</em> e cos&igrave; via).\nHo avuto l'opportunit&agrave; di mettere la mente e le mani direttamente nella gestione del progetto, seguendo diversi aspetti del ciclo di vita del progetto.\nGiusto per passione, curiosit&agrave; e interesse ho creato <strong>Bonzai</strong> (precedentemente chiamato phpGuardian), uno strumento open-source per la codifica dei progetti PHP. Questo mi ha tenuto coinvolto nel corso degli anni molto sullo studio del core di PHP, nella scrittura di un'estensione personalizzata in C e nell'analisi del codice sorgente."
    },
    "interest": {
        "en_GB": [
            "Programming",
            "Swimming",
            "Snowboarding",
            "Music",
            "Cooking"
        ],
        "it_IT": [
            "Programmazione",
            "Nuoto",
            "Snowboard",
            "Musica",
            "Cucinare"
        ]
    },
    "location": {
        "postal_code": "NW2",
        "city": {
            "en_GB": "London",
            "it_IT": "Londra"
        },
        "coordinates":  "51.558423,-0.212517",
        "country_code": "GB",
        "country": {
            "en_GB": "United Kingdom",
            "it_IT": "Regno Unito"
        }
    },
    "marital_status": "single",
    "name": {
        "first_name": "Fabio",
        "last_name":  "Cicerchia"
    },
    "nationality": {
        "en_GB": "italian",
        "it_IT": "italiana"
    },
    "role": "Web Developer",
    "social": {
        "facebook": "https:\/\/www.facebook.com\/fabio.cicerchia",
        "linkedin": "http:\/\/linkedin.com\/in\/fabiocicerchia",
        "github":   "https:\/\/github.com\/fabiocicerchia",
        "twitter":  "https:\/\/twitter.com\/fabiocicerchia"
    },
    "telephone": {
        "it": "+39 3480934577",
        "uk": "+44 7831192297"
    }
});

/* ========================================================================== */
/* =============================== LANGUAGE ================================= */
/* ========================================================================== */

/* Last Update: 2012-11-09 */
db.getCollection("language").insert({
    "_id": ObjectId("85925bcab2b54712b79426ab"), /* ID: LNGG-ENG */
    "code":  "en_GB",
    "knowledge": {
        "listening":          "B1",
        "reading":            "B1",
        "spoken interaction": "B1",
        "spoken production":  "B1",
        "writing":            "B1"
    },
    "language": {
        "en_GB": "English",
        "it_IT": "Inglese"
    },
    "native": 0
});

/* Last Update: 2012-11-09 */
db.getCollection("language").insert({
    "_id": ObjectId("6a256720091ba1a25b736550"), /* ID: LNGG-ITA */
    "code":  "it_IT",
    "knowledge": {
        "listening":          "C2",
        "reading":            "C2",
        "spoken interaction": "C2",
        "spoken production":  "C2",
        "writing":            "C2"
    },
    "language": {
        "en_GB": "Italian",
        "it_IT": "Italiano"
    },
    "native": 1
});

/* ========================================================================== */
/* ================================ SKILLS ================================== */
/* ========================================================================== */

/* Last Update: 2012-11-09 */
db.getCollection("skill").insert({
    "_id": ObjectId("b288aaa8fae961315780441a"), /* ID: SKLL-MTHDGS */
    "name": {
        "en_GB": "Methodologies",
        "it_IT": "Metodologie"
    },
    "list": [
        {
            "name": {
                "en_GB": "eXtreme Programming",
                "it_IT": "eXtreme Programming"
            },
            "proficiency": "beginner"
        },
        {
            "name": {
                "en_GB": "SCRUM",
                "it_IT": "SCRUM"
            },
            "proficiency": "beginner"
        },
        {
            "name": {
                "en_GB": "Waterfall Model",
                "it_IT": "Modello a Cascata"
            },
            "proficiency": "beginner"
        }
    ]
});

/* Last Update: 2012-11-09 */
db.getCollection("skill").insert({
    "_id": ObjectId("cfbcc133e67febd73bf1e48f"), /* ID: SKLL-TCHNQS */
    "name": {
        "en_GB": "Techniques",
        "it_IT": "Tecniche"
    },
    "list": [
        {
            "name": {
                "en_GB": "Automated Builds",
                "it_IT": "Build Automatizzate"
            },
            "proficiency": "intermediate"
        },
        {
            "name": {
                "en_GB": "Code Coverage",
                "it_IT": "Copertura del Codice"
            },
            "proficiency": "intermediate"
        },
        {
            "name": {
                "en_GB": "Continuous Integration",
                "it_IT": "Integrazione Continua"
            },
            "proficiency": "intermediate"
        },
        {
            "name": {
                "en_GB": "Defensive Programming",
                "it_IT": "Programmazione Difensiva"
            },
            "proficiency": "beginner"
        },
        {
            "name": {
                "en_GB": "DRY",
                "it_IT": "DRY"
            },
            "proficiency": "intermediate"
        },
        {
            "name": {
                "en_GB": "Functional Testing",
                "it_IT": "Test Funzionali"
            },
            "proficiency": "intermediate"
        },
        {
            "name": {
                "en_GB": "KISS",
                "it_IT": "KISS"
            },
            "proficiency": "intermediate"
        },
        {
            "name": {
                "en_GB": "Pair Programming",
                "it_IT": "Programmazione in Coppia"
            },
            "proficiency": "advanced"
        },
        {
            "name": {
                "en_GB": "PEP8",
                "it_IT": "PEP8"
            },
            "proficiency": "beginner"
        },
        {
            "name": {
                "en_GB": "Perl Best Practices",
                "it_IT": "Perl Best Practices"
            },
            "proficiency": "beginner"
        },
        {
            "name": {
                "en_GB": "Pomodoro Technique",
                "it_IT": "Tecnica del Pomodoro"
            },
            "proficiency": "intermediate"
        },
        {
            "name": {
                "en_GB": "Profiling",
                "it_IT": "Profilazione"
            },
            "proficiency": "intermediate"
        },
        {
            "name": {
                "en_GB": "PSR-2",
                "it_IT": "PSR-2"
            },
            "proficiency": "intermediate"
        },
        {
            "name": {
                "en_GB": "Static Code Analysis",
                "it_IT": "Analisi Statica del Codice"
            },
            "proficiency": "advanced"
        },
        {
            "name": {
                "en_GB": "Unit Testing",
                "it_IT": "Test Unitari"
            },
            "proficiency": "intermediate"
        },
        {
            "name": {
                "en_GB": "User Stories & Planning Poker",
                "it_IT": "Storie Utente & Planning Poker"
            },
            "proficiency": "advanced"
        },
        {
            "name": {
                "en_GB": "YAGNI",
                "it_IT": "YAGNI"
            },
            "proficiency": "beginner"
        }
    ]
});

/* Last Update: 2012-11-09 */
db.getCollection("skill").insert({
    "_id": ObjectId("7c10cf98c8a5d44876191452"), /* ID: SKLL-TCNLGS */
    "name": {
        "en_GB": "Technologies",
        "it_IT": "Tecnologie"
    },
    "list": [
        {
            "name":        "Apache",
            "proficiency": "intermediate"
        },
        {
            "name":        "ASP.net",
            "proficiency": "beginner"
        },
        {
            "name":        "ASP",
            "proficiency": "beginner"
        },
        {
            "name":        "Atom Syndication",
            "proficiency": "beginner"
        },
        {
            "name":        "AWS",
            "proficiency": "beginner"
        },
        {
            "name":        "Bash Shell",
            "proficiency": "advanced"
        },
        {
            "name":        "C",
            "proficiency": "beginner"
        },
        {
            "name":        "CSS 3",
            "proficiency": "beginner"
        },
        {
            "name":        "CSS",
            "proficiency": "intermediate"
        },
        {
            "name":        "Dublin Core Metadata",
            "proficiency": "beginner"
        },
        {
            "name":        "HTML 5",
            "proficiency": "intermediate"
        },
        {
            "name":        "HTML",
            "proficiency": "advanced"
        },
        {
            "name":        "IIS",
            "proficiency": "beginner"
        },
        {
            "name":        "JavaScript",
            "proficiency": "advanced"
        },
        {
            "name":        "JSON-RPC",
            "proficiency": "beginner"
        },
        {
            "name":        "Microdata",
            "proficiency": "beginner"
        },
        {
            "name":        "Microformat",
            "proficiency": "beginner"
        },
        {
            "name":        "MongoDB",
            "proficiency": "beginner"
        },
        {
            "name":        "MySQL",
            "proficiency": "advanced"
        },
        {
            "name":        "Oracle",
            "proficiency": "beginner"
        },
        {
            "name":        "Perl",
            "proficiency": "beginner"
        },
        {
            "name":        "PHP",
            "proficiency": "expert"
        },
        {
            "name":        "PostgreSQL",
            "proficiency": "intermediate"
        },
        {
            "name":        "Python",
            "proficiency": "beginner"
        },
        {
            "name":        "Redis",
            "proficiency": "beginner"
        },
        {
            "name":        "REST",
            "proficiency": "beginner"
        },
        {
            "name":        "RSS",
            "proficiency": "intermediate"
        },
        {
            "name":        "Sitemaps XML",
            "proficiency": "intermediate"
        },
        {
            "name":        "SQLite",
            "proficiency": "intermediate"
        },
        {
            "name":        "SQL Server",
            "proficiency": "beginner"
        },
        {
            "name":        "vCard",
            "proficiency": "beginner"
        },
        {
            "name":        "Visual Basic",
            "proficiency": "beginner"
        },
        {
            "name":        "XHTML",
            "proficiency": "advanced"
        },
        {
            "name":        "XML",
            "proficiency": "intermediate"
        }
    ]
});

/* Last Update: 2012-11-09 */
db.getCollection("skill").insert({
    "_id": ObjectId("2b3291df51f7424fdb0e11a9"), /* ID: SKLL-TLS */
    "name": {
        "en_GB": "Tools",
        "it_IT": "Strumenti"
    },
    "list": [
        {
            "name":        "Alfresco",
            "proficiency": "beginner"
        },
        {
            "name":        "ApiGen",
            "proficiency": "beginner"
        },
        {
            "name":        "Automake",
            "proficiency": "beginner"
        },
        {
            "name":        "capifony",
            "proficiency": "beginner"
        },
        {
            "name":        "Capistrano",
            "proficiency": "beginner"
        },
        {
            "name":        "CPAN Minus",
            "proficiency": "beginner"
        },
        {
            "name":        "cUnit",
            "proficiency": "beginner"
        },
        {
            "name":        "CVS",
            "proficiency": "intermediate"
        },
        {
            "name":        "DDD",
            "proficiency": "beginner"
        },
        {
            "name":        "Devel::Cover",
            "proficiency": "beginner"
        },
        {
            "name":        "DocBlox",
            "proficiency": "intermediate"
        },
        {
            "name":        "DokuWiki",
            "proficiency": "intermediate"
        },
        {
            "name":        "Doxygen",
            "proficiency": "intermediate"
        },
        {
            "name":        "epydoc",
            "proficiency": "beginner"
        },
        {
            "name":        "FastESP",
            "proficiency": "beginner"
        },
        {
            "name":        "Firebug",
            "proficiency": "intermediate"
        },
        {
            "name":        "Flyspray",
            "proficiency": "beginner"
        },
        {
            "name":        "GDB",
            "proficiency": "beginner"
        },
        {
            "name":        "gedit",
            "proficiency": "advanced"
        },
        {
            "name":        "Git Extras",
            "proficiency": "beginner"
        },
        {
            "name":        "Git Flow",
            "proficiency": "beginner"
        },
        {
            "name":        "Git",
            "proficiency": "intermediate"
        },
        {
            "name":        "Google Minify",
            "proficiency": "intermediate"
        },
        {
            "name":        "GreenHopper",
            "proficiency": "beginner"
        },
        {
            "name":        "Hudson",
            "proficiency": "intermediate"
        },
        {
            "name":        "Jenkins",
            "proficiency": "intermediate"
        },
        {
            "name":        "Jira",
            "proficiency": "advanced"
        },
        {
            "name":        "Joomla",
            "proficiency": "advanced"
        },
        {
            "name":        "jQuery",
            "proficiency": "advanced"
        },
        {
            "name":        "Mantis",
            "proficiency": "intermediate"
        },
        {
            "name":        "NetBeans",
            "proficiency": "intermediate"
        },
        {
            "name":        "nikto",
            "proficiency": "beginner"
        },
        {
            "name":        "Notepad++",
            "proficiency": "intermediate"
        },
        {
            "name":        "osCommerce",
            "proficiency": "intermediate"
        },
        {
            "name":        "OWASP - Core Rule Set",
            "proficiency": "beginner"
        },
        {
            "name":        "pep8",
            "proficiency": "beginner"
        },
        {
            "name":        "Perl::Critic",
            "proficiency": "beginner"
        },
        {
            "name":        "perltidy",
            "proficiency": "beginner"
        },
        {
            "name":        "PHP_CodeBrowser",
            "proficiency": "beginner"
        },
        {
            "name":        "PHP_CodeCoverage",
            "proficiency": "intermediate"
        },
        {
            "name":        "PHP_CodeSniffer",
            "proficiency": "intermediate"
        },
        {
            "name":        "phpBB",
            "proficiency": "intermediate"
        },
        {
            "name":        "phpcov",
            "proficiency": "beginner"
        },
        {
            "name":        "phpcpd",
            "proficiency": "beginner"
        },
        {
            "name":        "PHP-CS-Fixer",
            "proficiency": "intermediate"
        },
        {
            "name":        "PHP Depend",
            "proficiency": "beginner"
        },
        {
            "name":        "phpDocumentor 2",
            "proficiency": "advanced"
        },
        {
            "name":        "phpDocumentor",
            "proficiency": "advanced"
        },
        {
            "name":        "phploc",
            "proficiency": "beginner"
        },
        {
            "name":        "PHP Mess Detector",
            "proficiency": "intermediate"
        },
        {
            "name":        "PHP-Nuke",
            "proficiency": "beginner"
        },
        {
            "name":        "phpt",
            "proficiency": "beginner"
        },
        {
            "name":        "PHPUnit",
            "proficiency": "advanced"
        },
        {
            "name":        "pirum",
            "proficiency": "beginner"
        },
        {
            "name":        "Poedit",
            "proficiency": "beginner"
        },
        {
            "name":        "Prototype",
            "proficiency": "intermediate"
        },
        {
            "name":        "pylint",
            "proficiency": "beginner"
        },
        {
            "name":        "Selenium",
            "proficiency": "intermediate"
        },
        {
            "name":        "Silex-Extension",
            "proficiency": "intermediate"
        },
        {
            "name":        "Silex",
            "proficiency": "intermediate"
        },
        {
            "name":        "Sonar",
            "proficiency": "beginner"
        },
        {
            "name":        "Splint",
            "proficiency": "beginner"
        },
        {
            "name":        "Sublime Text",
            "proficiency": "advanced"
        },
        {
            "name":        "SVN",
            "proficiency": "advanced"
        },
        {
            "name":        "Symfony",
            "proficiency": "advanced"
        },
        {
            "name":        "Template Toolkit",
            "proficiency": "beginner"
        },
        {
            "name":        "Test::More",
            "proficiency": "beginner"
        },
        {
            "name":        "TravisCI",
            "proficiency": "intermediate"
        },
        {
            "name":        "Twitter Bootstrap",
            "proficiency": "beginner"
        },
        {
            "name":        "Valgrind",
            "proficiency": "beginner"
        },
        {
            "name":        "vim",
            "proficiency": "intermediate"
        },
        {
            "name":        "Wordpress",
            "proficiency": "intermediate"
        },
        {
            "name":        "YSlow",
            "proficiency": "intermediate"
        },
        {
            "name":        "Zend Framework",
            "proficiency": "beginner"
        }
    ]
});

/* ========================================================================== */
/* ============================ SYSTEM INDEXES ============================== */
/* ========================================================================== */

db.getCollection("system.indexes").insert({
    "v":    1,
    "key":  {"_id": 1},
    "ns":   "curriculum.education",
    "name": "_id_"
});
db.getCollection("system.indexes").insert({
    "v":    1,
    "key":  {"_id": 1},
    "ns":   "curriculum.experience",
    "name": "_id_"
});
db.getCollection("system.indexes").insert({
    "v":    1,
    "key":  {"_id": 1},
    "ns":   "curriculum.information",
    "name": "_id_"
});
db.getCollection("system.indexes").insert({
    "v":    1,
    "key":  {"_id": 1},
    "ns":   "curriculum.skill",
    "name": "_id_"
});
db.getCollection("system.indexes").insert({
    "v":    1,
    "key":  {"_id": 1},
    "ns":   "curriculum.language",
    "name": "_id_"
});
