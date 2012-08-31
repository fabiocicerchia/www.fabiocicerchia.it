/**
 * FABIO CICERCHIA - WEBSITE
 *
 * Copyright 2012 Fabio Cicerchia. All rights reserved.
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

/** education indexes **/
db.getCollection("education").ensureIndex({"_id": 1}, []);

/** experience indexes **/
db.getCollection("experience").ensureIndex({"_id": 1}, []);

/** information indexes **/
db.getCollection("information").ensureIndex({"_id": 1}, []);

/** language indexes **/
db.getCollection("language").ensureIndex({"_id": 1}, []);

/** skill indexes **/
db.getCollection("skill").ensureIndex({"_id": 1}, []);

/** education records **/
db.getCollection("education").insert({
    "_id": ObjectId("4fc7b39af7c5e27a69b8d79b"),
    "title": {
        "en_GB": "Pre-Intermediate English",
        "it_IT": "Inglese Pre-Intermedio"
    },
    "institute": {
        "name": "British Study Centre",
        "url":  "http:\/\/www.british-study.com",
        "location": {
            "address": "Hannah House, 13-16 Manchester Street",
            "postal_code":     "W1U 4DJ",
            "city": {
                "en_GB": "London",
                "it_IT": "Londra"
            },
            "country": {
                "en_GB": "United Kingdom",
                "it_IT": "Regno Unito"
            }
        }
    },
    "date": {
        "start": ISODate("2012-04-02T00:00:00"),
        "end":   ISODate("2012-04-27T00:00:00"),
        "hours": 80
    },
    "activities": {
        "en_GB": ["Grammar", "Vocabulary", "Reading", "Writing", "Pronunciation", "Speaking", "Listening"],
        "it_IT": ["Grammatica","Vocabolario", "Lettura", "Scrittura", "Pronuncia", "Produzione Orale", "Ascolto"]
    }
});
db.getCollection("education").insert({
    "_id": ObjectId("4fc7b402f7c5e27a69b8d7a1"),
    "activities": {
        "en_GB": ["CIW Associate", "CIW Application Developer", "At least 2 years of work experience"],
        "it_IT": ["CIW Associate", "CIW Application Developer", "Almeno 2 anni di esperienza lavorativa"]
    },
    "date": {
        "start": ISODate("2011-04-27T00:00:00"),
        "end":   ISODate("2011-04-27T00:00:00")
    },
    "institute": {
        "name": "IWA",
        "url":  "http:\/\/www.iwanet.org"
    },
    "title": {
        "en_GB": "IWA Certified Web Professional Application Developer",
        "it_IT": "IWA Certified Web Professional Application Developer"
    }
});
db.getCollection("education").insert({
    "_id": ObjectId("4fc7b3f2f7c5e27a69b8d79f"),
    "activities": {
        "en_GB": ["Fundamentals of CGI Using Perl", "Dynamic Server Pages"],
        "it_IT": ["Fondamenti di CGI utilizzando Perl", "Dynamic Server Pages"]
    },
    "date": {
        "start": ISODate("2011-02-08T00:00:00"),
        "end":   ISODate("2011-02-08T00:00:00")
    },
    "institute": {
        "name": "CIW Prometric Test Center 'Finsa Tech S.r.l.'",
        "location": {
            "address": "Via dei Gracchi, 209",
            "postal_code":     "00192",
            "city": {
                "en_GB": "Rome",
                "it_IT": "Roma"
            },
            "country": {
                "en_GB": "Italy",
                "it_IT": "Italia"
            }
        }
    },
    "title": {
        "en_GB": "CIW Application Developer",
        "it_IT": "CIW Application Developer"
    }
});
db.getCollection("education").insert({
    "_id": ObjectId("4fc7b3eaf7c5e27a69b8d79e"),
    "activities": {
        "en_GB": ["Internet Business Foundation", "Site Development Foundation", "Network Technology Foundation"],
        "it_IT": ["Fondamenti di Business Internet", "Fondamenti di Sviluppo Siti", "Fondamenti di Tecnologie di Rete"]
    },
    "date": {
        "start": ISODate("2009-09-23T00:00:00"),
        "end":   ISODate("2009-09-23T00:00:00")
    },
    "institute": {
        "name": "CIW Prometric Test Center 'Atrak S.r.l.'",
        "location": {
            "address": "Via Valentino Mazzola, 66",
            "postal_code":     "00142",
            "city": {
                "en_GB": "Rome",
                "it_IT": "Roma"
            },
            "country": {
                "en_GB": "Italy",
                "it_IT": "Italia"
            }
        }
    },
    "title": {
        "en_GB": "CIW Associate",
        "it_IT": "Associato CIW"
    }
});
db.getCollection("education").insert({
    "_id": ObjectId("4fc7b3e3f7c5e27a69b8d79d"),
    "activities": {
        "en_GB": ["PHP Basics", "Functions", "Arrays", "Object Oriented Programming", "Security", "XML and Web Services", "Strings and Patterns", "Database and SQL", "User Interaction (Form, Session, Cookie, HTTP Header)", "Stream and Files", "PHP 4 and PHP 5 Differences", "Theory and Design"],
        "it_IT": ["Basi di PHP", "Funzioni", "Array", "Programmazione Orientata agli Oggetti", "Sicurezza", "XML e Web Services", "Stringhe e Patterns", "Database e SQL", "Interazione Utente (Form, Sessioni, Cookie, HTTP Header)", "Flussi e Files", "Differenze tra PHP 4 e PHP 5", "Teoria e Progettazione"]
    },
    "date": {
        "start": ISODate("2008-06-25T00:00:00"),
        "end":   ISODate("2008-06-25T00:00:00")
    },
    "institute": {
        "name": "Zend Pearson Vue Authorised Test Center 'IPSIA Carlo Cattaneo'",
        "location": {
            "address": "Via Antonio Pisano, 9",
            "postal_code":     "00142",
            "city": {
                "en_GB": "Rome",
                "it_IT": "Roma"
            },
            "country": {
                "en_GB": "Italy",
                "it_IT": "Italia"
            }
        }
    },
    "title": {
        "en_GB": "Zend Certified Engineer",
        "it_IT": "Ingegnere Certificato Zend"
    }
});
db.getCollection("education").insert({
    "_id": ObjectId("4fc7b3faf7c5e27a69b8d7a0"),
    "activities": {
        "en_GB": ["Basic concepts of Information Technology", "Using the computer and managing files", "Word processing", "Spreadsheets", "Database", "Presentation", "Information and communication"],
        "it_IT": ["Concetti di base della IT", "Uso del computer - Gestione files", "Elaborazione testi", "Foglio elettronico", "Database", "Presentazione", "Reti informatiche - Internet"]
    },
    "date": {
        "start": ISODate("2005-10-24T00:00:00"),
        "end":   ISODate("2005-12-19T00:00:00"),
        "hours": 5
    },
    "institute": {
        "name": "AICA",
        "url":  "http:\/\/www.aicanet.it",
        "location": {
            "postal_code": "00012",
            "city": {
                "en_GB": "Guidonia Montecelio",
                "it_IT": "Guidonia Montecelio"
            },
            "country": {
                "en_GB": "Italy",
                "it_IT": "Italia"
            }
        }
    },
    "title": {
        "en_GB": "ECDL Core",
        "it_IT": "ECDL Core"
    }
});
db.getCollection("education").insert({
    "_id": ObjectId("4fc7b3d9f7c5e27a69b8d79c"),
    "title": {
        "en_GB": "Industrial Expert Technician - Computer Science Specialization Project 'ABACUS'",
        "it_IT": "Perito Industriale Capo Tecnico Specializzazione: Informatica \"Abacus\""
    },
    "institute": {
        "name": "ITIS Enrico Fermi",
        "url":  "http:\/\/www.fermifrascati.it\/",
        "location": {
            "address": "Via Cesare Minardi, 14",
            "postal_code":     "00044",
            "city": {
                "en_GB": "Frascati",
                "it_IT": "Frascati"
            },
            "country": {
                "en_GB": "Italy",
                "it_IT": "Italia"
            }
        }
    },
    "date": {
        "start": ISODate("2000-09-04T00:00:00"),
        "end":   ISODate("2005-07-05T00:00:00"),
        "hours": 5676
    },
    "activities": {
        "en_GB": ["Italian language and literature", "History", "Foreign language (English)", "Law and Economics", "Geography", "Mathematics", "Earth Sciences", "Biology", "Physics and laboratory", "Chemistry and laboratory", "Technology and Drawing", "Calculus of probability, Statistics, Operative Research", "Electronics", "Generic Computer Science", "Computing systems and elaboration's transmission", "Physical Education"],
        "it_IT": ["Lingua e Lettere Italiane", "Storia", "Lingua straniera (Inglese)", "Diritto ed Economia", "Geografia", "Matematica", "Scienze della Terra", "Biologia", "Fisica e laboratorio", "Chimica e laboratorio", "Tecnologia e disegno", "Calcolo delle probabilita, Statistica, Ricerca Operativa", "Elettronica", "Informatica Generale", "Sistemi di elaborazione e trasmissione dell'elaborazione", "Educazione Fisica"]
    }
});

/** experience records **/
db.getCollection("experience").insert({
    "_id": ObjectId("4fc7b57df7c5e27a69b8d7a6"),
    "role": {
        "en_GB": "LAMP \/ PHP Developer",
        "it_IT": "Sviluppatore LAMP \/ PHP"
    },
    "company": {
        "name": "FusePump Limited",
        "url":  "http:\/\/www.fusepump.com",
        "location": {
            "address": "Lower Ground Floor, 20-23 Greville Street",
            "postal_code":     "EC1N 8SS",
            "city": {
                "en_GB": "London",
                "it_IT": "Londra"
            },
            "country": {
                "en_GB": "United Kingdom",
                "it_IT": "Regno Unito"
            }
        }
    },
    "date": {
        "start": ISODate("2012-04-30T00:00:00"),
        "end": -1
    },
    "techniques": {
        "Code Coverage":               {"months": 2},
        "Pair Programming":            {"months": 2},
        "Profiling":                   {"months": 2},
        "Source Code Analysis":        {"months": 2},
        "Unit and Functional Testing": {"months": 3}
    },
    "technologies": {
        "JavaScript": {"months": 3},
        "PHP":        {"months": 4},
        "MySQL":      {"months": 4},
        "XML":        {"months": 4},
        "Redis":      {"months": 2},
        "MongoDB":    {"months": 2}
    },
    "tools": {
        "SVN":            {"months": 4},
        "Jira":           {"months": 2},
        "Zend Framework": {"months": 2}
    }
});
db.getCollection("experience").insert({
    "_id": ObjectId("4fc7b5edf7c5e27a69b8d7a9"),
    "role": {
        "en_GB": "Consultant",
        "it_IT": "Consulente"
    },
    "company": {
        "name": "Fabio Cicerchia",
        "address": {
            "postal_code": "00036",
            "city": {
                "en_GB": "Palestrina",
                "it_IT": "Palestrina"
            },
            "country": {
                "en_GB": "Italy",
                "it_IT": "Italia"
            }
        }
    },
    "date": {
        "start": ISODate("2003-05-01T00:00:00"),
        "end":   -1
    },
    "description": {
        "en_GB": "Web sites development and implementation (showcase sites and custom web applications).\nFrom June 2006 development and project management of Bonzai (planning, design, development and maintaining).\nFrom August 2005 collaboration with the Art Director Jeroen Bertsch. Development of showcase sites with Wordpress and customized systems.",
        "it_IT": "Sviluppo e realizzazione siti web (siti vetrina e applicazioni web personalizzate).\nDa Giugno 2006 sviluppo e gestione del progetto Bonzai ( pianificazione, progettazione, sviluppo e manutenzione).\nDa Agosto 2005 collaborazione con l'Art Director Jeroen Bertsch. Realizzazione di siti vetrina con Wordpress e con sistemi ad-hoc."
    },
    "projects": [
        {
            "name": "Bonzai",
            "url":  "http:\/\/www.bonzai-project.org",
            "date": {
                "start": ISODate("2006-08-22T00:00:00"),
                "end":   -1
            },
            "role": {
                "en_GB": "Lead Web & Software Developer",
                "it_IT": "Lead Web & Software Developer"
            },
            "description": {
                "en_GB": "My own project that convert plain PHP sources to PHP compiled bytecode (through bcompiler extension).",
                "it_IT": "Il mio progetto personale che trasforma i sorgenti PHP in bytecode (attraverso l'estensione bcompiler)."
            },
            "activities": {
                "en_GB": ["Feature Development and Code Maintenance", "Website Maintenance, repository PEAR", "Documentation"],
                "it_IT": ["Implementazione feature e Manutenzione del codice", "Manutenzione sito web, repository PEAR", "Documentazione"]
            },
            "technologies": {
                "C":     {"months": 8},
                "PHP":   {"months": 24},
                "MySQL": {"months": 4}
            },
            "tools": {
                "CVS":            {"months": 6},
                "GIT":            {"months": 12},
                "cUnit":          {"months": 8},
                "phpUnit":        {"months": 12},
                "Automake":       {"months": 7},
                "Splint":         {"months": 8}
            }
        }
    ],
    "techniques": {
        "Automated Builds":            {"months": '-'},
        "Code Coverage":               {"months": '-'},
        "Continuous Integration":      {"months": '-'},
        "Pomodoro Technique":          {"months": '-'},
        "Profiling":                   {"months": '-'},
        "Source Code Analysis":        {"months": '-'},
        "Unit and Functional Testing": {"months": '-'}
    },
    "technologies": {
        "JavaScript": {"months": '-'},
        "PHP":        {"months": '-'},
        "MySQL":      {"months": '-'},
        "SQLite":     {"months": '-'},
        "C":          {"months": '-'}
    },
    "tools": {
        "jQuery":         {"months": '-'},
        "Prototype":      {"months": '-'},
        "Wordpress":      {"months": '-'},
        "Zend Framework": {"months": '-'},
        "Joomla":         {"months": '-'},
        "Silex":          {"months": '-'},
        "Symfony":        {"months": '-'},
        "CVS":            {"months": '-'},
        "GIT":            {"months": '-'},
        "cUnit":          {"months": '-'},
        "phpUnit":        {"months": '-'},
        "Automake":       {"months": '-'},
        "Splint":         {"months": '-'},
        "Jenkins":        {"months": '-'},
        "Sonar":          {"months": '-'},
        "Mantis":         {"months": '-'}
    }
});
db.getCollection("experience").insert({
    "_id": ObjectId("4fc7b5bbf7c5e27a69b8d7a8"),
    "role": {
        "en_GB": "PHP Developer",
        "it_IT": "Sviluppatore PHP"
    },
    "company": {
        "name": "Dnsee (Interactive Thinking S.r.l.)",
        "url":  "http:\/\/www.dnsee.com",
        "location": {
            "address": "Via Flaminia Vecchia, 495",
            "postal_code":     "00191",
            "city": {
                "en_GB": "Rome",
                "it_IT": "Roma"
            },
            "country": {
                "en_GB": "Italy",
                "it_IT": "Italia"
            }
        }
    },
    "date": {
        "start": ISODate("2010-06-21T00:00:00"),
        "end":   ISODate("2012-03-30T00:00:00")
    },
    "projects": [
        {
            "name": "Samsung Galaxy S",
            "date": {
                "start": ISODate("2010-06-21T00:00:00"),
                "end":   ISODate("2012-10-01T00:00:00")
            },
            "role": {
                "en_GB": "Web Developer",
                "it_IT": "Sviluppatore Web"
            },
            "description": {
                "en_GB": "Development of a mini website for Samsung for the Samsung Galaxy S launch",
                "it_IT": "Sviluppo di un minisito per Samsung per il lancio del Samsung Galaxy S"
            },
            "technologies": {
                "PHP":   {"months": 2},
                "MySQL": {"months": 2}
            },
            "tools": {
                "Symfony": {"months": 2}
            }
        },
        {
            "name": "Policlinic Campus Biomedical of Rome",
            "url":  "http:\/\/www.policlinicocampusbiomedico.it",
            "date": {
                "start": ISODate("2010-07-28T00:00:00"),
                "end":   ISODate("2011-02-01T00:00:00")
            },
            "role": {
                "en_GB": "Web Developer",
                "it_IT": "Web Developer"
            },
            "description": {
                "en_GB": "Integration into Joomla CMS some custom features like photo and video gallery, custom search to find doctors and appointments with the possibility to book or cancel them, integration and aggregation of clinical departments retrieved by an external service.",
                "it_IT": "Integrazione in Joomla CMS di alcune funzioni personalizzate, come foto e video gallery, ricerca personalizzata per trovare medici e appuntamenti con la possibilit&agrave; di prenotare o cancellare, integrazione e aggregazione di reparti clinici recuperati da un servizio esterno."
            },
            "technologies": {
                "PHP":        {"months": 6},
                "MySQL":      {"months": 6},
                "Oracle":     {"months": 2},
                "SQL Server": {"months": 2}
            },
            "tools": {
                "Joomla": {"months": 4}
            }
        },
        {
            "name": "San Raffaele",
            "url":  "http:\/\/www.sanraffaele.it",
            "date": {
                "start": ISODate("2010-10-05T00:00:00"),
                "end":   ISODate("2012-03-30T00:00:00")
            },
            "role": {
                "en_GB": "Lead Web Developer",
                "it_IT": "Lead Web Developer"
            },
            "description": {
                "en_GB": "Development and Project Management of a multilanguage web portal for a big italian healthcare company.\nThe portal ranging from a CMS to health structure management (which are composed of department) through some form of profiled user registration, booking, contact and form to ask question directly to doctors.\nThere are available also a supplier management system (registration, payment, confidential documents archive) and formation system to manage all the courses provided from internal and externals universities, with the possibility to book them.",
                "it_IT": "Sviluppo e Project Management di un portale web multilingue per una grande azienda sanitaria italiana.\nIl portale spazia da un CMS per la gestione delle strutture sanitarie (che si compongono di dipartimenti) attraverso varie form di registrazione di utenti profilati, form di prenotazione, contatti e modulo per fare domanda direttamente ai medici.\nSono a disposizione anche un sistema di gestione dei fornitori (registrazione, pagamento, archivio documenti riservati) ed un sistema di formazione per gestire tutti i corsi previsti da universit&agrave; interne ed esterne, con la possibilit&agrave; di prenotarli."
            },
            "methodologies": {
                "SCRUM":               {"months": 7},
                "eXtreme Programming": {"months": 10}
            },
            "techniques": {
                "Automated Builds":              {"months": 12},
                "Continuous Integration":        {"months": 12},
                "Pair Programming":              {"months": 12},
                "Pomodoro Technique":            {"months": 6},
                "Unit and Functional Testing":   {"months": 17},
                "User Stories & Planning Poker": {"months": 17}
            },
            "technologies": {
                "JavaScript": {"months": 17},
                "PHP":        {"months": 17},
                "MySQL":      {"months": 17},
                "SQLite":     {"months": 10}
            },
            "tools": {
                "jQuery":    {"months": 17},
                "Symfony":   {"months": 17},
                "SVN":       {"months": 17},
                "Jira":      {"months": 17},
                "Hudson":    {"months": 12},
                "Alfresco":  {"months": 17}
            }
        }
    ],
    "methodologies": {
        "SCRUM":               {"months": 9},
        "eXtreme Programming": {"months": 12}
    },
    "techniques": {
        "Automated Builds":              {"months": 12},
        "Continuous Integration":        {"months": 12},
        "Pair Programming":              {"months": 21},
        "Pomodoro Technique":            {"months": 6},
        "Unit and Functional Testing":   {"months": 21},
        "User Stories & Planning Poker": {"months": 21}
    },
    "technologies": {
        "JavaScript": {"months": 21},
        "PHP":        {"months": 21},
        "MySQL":      {"months": 21},
        "SQLite":     {"months": 12},
        "SQL Server": {"months": 5},
        "Oracle":     {"months": 5}
    },
    "tools": {
        "jQuery":    {"months": 21},
        "Symfony":   {"months": 21},
        "Silex":     {"months": 6},
        "Joomla":    {"months": 6},
        "Wordpress": {"months": 6},
        "SVN":       {"months": 21},
        "Jira":      {"months": 21},
        "Hudson":    {"months": 12},
        "Alfresco":  {"months": 21}
    }
});
db.getCollection("experience").insert({
    "_id": ObjectId("4fc7b587f7c5e27a69b8d7a7"),
    "role": {
        "en_GB": "Web Developer",
        "it_IT": "Sviluppatore Web"
    },
    "company": {
        "name": "Populis s.r.l. (ex GoAdv s.r.l.)",
        "url":  "http:\/\/www.populis.com",
        "location": {
            "address": "Via Cristoforo Colombo, 112",
            "postal_code":     "001947",
            "city": {
                "en_GB": "Rome",
                "it_IT": "Roma"
            },
            "country": {
                "en_GB": "Italy",
                "it_IT": "Italia"
            }
        }
    },
    "date": {
        "start": ISODate("2008-01-02T00:00:00"),
        "end":   ISODate("2010-06-18T00:00:00")
    },
    "methodologies": {
        "Waterfall Model": {"months": 30}
    },
    "techniques": {
        "Pair Programming":            {"months": 30},
        "Unit and Functional Testing": {"months": 24}
    },
    "technologies": {
        "JavaScript": {"months": 30},
        "PHP":        {"months": 30},
        "MySQL":      {"months": 30},
        "PostgreSQL": {"months": 12},
        "Python":     {"months": 6}
    },
    "tools": {
        "Prototype":      {"months": 12},
        "jQuery":         {"months": 12},
        "Wordpress":      {"months": 18},
        "Zend Framework": {"months": 6},
        "Joomla":         {"months": 6},
        "CVS":            {"months": 30},
        "SVN":            {"months": 30},
        "FastESP":        {"months": 6}
    }
});
db.getCollection("experience").insert({
    "_id": ObjectId("4fc7b550f7c5e27a69b8d7a3"),
    "role": {
        "en_GB": "Web \/ Software Developer",
        "it_IT": "Sviluppatore Web & Software"
    },
    "company": {
        "name": "ADQ S.p.A.",
        "location": {
            "address": "Via Barnaba Tortolini, 5",
            "postal_code":     "00197",
            "city": {
                "en_GB": "Rome",
                "it_IT": "Roma"
            },
            "country": {
                "en_GB": "Italy",
                "it_IT": "Italia"
            }
        }
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
            "name": "StockInformatica",
            "date": {
                "start": ISODate("2007-05-24T00:00:00"),
                "end":   ISODate("2007-12-31T00:00:00")
            },
            "role": {
                "en_GB": "Web & Software Developer",
                "it_IT": "Sviluppatore Web & Software"
            },
            "description": {
                "en_GB": "Maintenance and subsequent re-development of an e-commerce site that sold electronic and computer products.",
                "it_IT": "Manutenzione e successivo rifacimento di un sito e-commerce che vendeva prodotti di elettronica e computer."
            },
            "methodologies": {
                "Waterfall Model": {"months": 8}
            },
            "technologies": {
                "PHP":          {"months": 8},
                "ASP":          {"months": 8},
                "MySQL":        {"months": 8},
                "Visual Basic": {"months": 4}
            },
            "tools": {
                "osCommerce": {"months": 8}
            }
        },
        {
            "name": "ItalianCamper",
            "date": {
                "start": ISODate("2007-05-24T00:00:00"),
                "end":   ISODate("2007-12-31T00:00:00")
            },
            "role": {
                "en_GB": "Web Developer",
                "it_IT": "Sviluppatore Web"
            },
            "methodologies": {
                "Waterfall Model": {"months": 8}
            },
            "technologies": {
                "PHP":   {"months": 8},
                "MySQL": {"months": 8}
            },
            "tools": {
                "PHP-Nuke": {"months": 8}
            }
        },
        {
            "name": "NoPayZone",
            "date": {
                "start": ISODate("2007-08-30T00:00:00"),
                "end":   ISODate("2007-09-28T00:00:00")
            },
            "role": {
                "en_GB": "Web & Software Developer",
                "it_IT": "Sviluppatore Web & Software"
            },
            "methodologies": {
                "Waterfall Model": {"months": 1}
            },
            "technologies": {
                "PHP":          {"months": 1},
                "MySQL":        {"months": 1},
                "Visual Basic": {"months": 1}
            },
            "tools": {
                "Wordpress": {"months": 4}
            }
        },
        {
            "name": "CoolZone",
            "date": {
                "start": ISODate("2012-08-30T00:00:00"),
                "end":   ISODate("2012-09-28T00:00:00")
            },
            "role": {
                "en_GB": "Web Developer",
                "it_IT": "Sviluppatore Web"
            },
            "methodologies": {
                "Waterfall Model": {"months": 1}
            },
            "technologies": {
                "PHP":   {"months": 1},
                "MySQL": {"months": 1}
            }
        }
    ]
});
db.getCollection("experience").insert({
    "_id": ObjectId("4fc7b565f7c5e27a69b8d7a4"),
    "role": {
        "en_GB": "Web Developer",
        "it_IT": "Sviluppatore Web"
    },
    "company": {
        "name": "The Italian Touch",
        "location": {
            "postal_code": "00036",
            "city": {
                "en_GB": "Palestrina",
                "it_IT": "Palestrina"
            },
            "country": {
                "en_GB": "Italy",
                "it_IT": "Italia"
            }
        }
    },
    "date": {
        "start": ISODate("2005-10-03T00:00:00"),
        "end":   ISODate("2006-10-02T00:00:00")
    }
});
db.getCollection("experience").insert({
    "_id": ObjectId("4fc7b572f7c5e27a69b8d7a5"),
    "role": {
        "en_GB": "Hardware \/ Software Consultant",
        "it_IT": "Consulente Hardware \/ Software"
    },
    "company": {
        "name": "Studio Bonito",
        "location": {
            "address": "Via della Basilica Romana, 36",
            "postal_code":     "00036",
            "city": {
                "en_GB": "Palestrina",
                "it_IT": "Palestrina"
            },
            "country": {
                "en_GB": "Italy",
                "it_IT": "Italia"
            }
        }
    },
    "date": {
        "start": ISODate("2004-05-01T00:00:00"),
        "end":   ISODate("2005-10-01T00:00:00")
    }
});

/** information records **/
db.getCollection("information").insert({
    "_id": ObjectId("4fc7b628f7c5e27a69b8d7aa"),
    "birth_day": ISODate("1986-02-09T00:00:00"),
    "contacts": {
        "msn":   "fabio.cicerchia@live.it",
        "skype": "fabio.cicerchia",
        "email": "info@fabiocicerchia.it"
    },
    "gender": {
        "en_GB": "male",
        "it_IT": "maschio",
    },
    "info": {
        "en_GB": "I'm a passionate <strong>Web Developer</strong>, I'm often hands on either <em>front-end</em> or <em>back-end</em>.\nFortunately I'm looking at any time for new challenges and trying to keep myself at the <strong>cutting edge</strong>. When isn't possible at work I always find the <em>time at home to study</em> new technologies and methodologies to apply the next day.\nSince the early 2000s I've been focused on the web development, and now almost totally involved with <strong>PHP</strong> and <strong>JS</strong> applications. I've certified myself as <em>PHP 5 Engineer</em> and <em>IWA Application Developer</em>.\nEvery my working day has a heavy sprinkle of shell-interaction during which I enjoy myself with <em>regular expressions</em> and <em>scripting</em>. But I'm not 100% of my time in front a black screen with green characters (even because thay aren't), I don't dislike at all <strong>refactoring</strong>, <strong>code documentation</strong>, and <strong>testing</strong> that are anything but boring.\nI like also work in such different areas like <strong>SEO</strong>, <strong>Accessibility</strong> and <strong>Project Management</strong>.\nLately I've been involved in the learning of <em>MongoDB</em>, <em>Perl</em>, <em>Python</em>, <em>Redis</em>, <em>XPath</em>, <em>Zend Framework</em>. Some of them for fun, some others for work. The last year I was totally committed on a big project developed using the RAD framework <strong>Symfony</strong> (with <strong>Doctrine</strong>) and practices like automated tests. I've got experience about <strong>agile development</strong> because we implemented some of the agile techniques (<em>iteration planning</em>, <em>test-first</em>, <em>collective code ownership</em> and so on).\nI had the opportunity to put mind and hands directly on the project management, following several aspects of the project life-cycle.\nJust for passion, curiosity and interest I've created <strong>Bonzai</strong> (formerly known as phpGuardian), an open-source tool for encoding the PHP projects. That kept me involved over the years a lot on the study of the PHP Core, the writing of a custom extension in C and the source code analysis.",
        "it_IT": "Sono un <strong>Web Developer</strong> appassionato, spesso con le mani su <em>front-end</em> e <em>back-end</em>.\n Fortunatamente sono in cerca in ogni momento di nuove sfide e sto cercando di <strong>tenermi all'avanguardia</strong>. Quando non è possibile al lavoro trovo sempre il tempo a casa per studiare nuove tecnologie e metodologie da applicare il giorno successivo. Dai primi anni 2000 sono stato concentrato sullo sviluppo web, e ora quasi totalmente impegnato con applicazioni <strong>PHP</strong> e <strong>JS</strong>. Mi sono certificato come <em>PHP 5 Engineer</em> e <em>IWA Application Developer</em>.\n Ogni mia giornata di lavoro ha una bella spruzzata di interazione con la shell durante la quala mi diverto con <em>espressioni regolari</em> e <em>scripting</em>. Ma non sono il 100% del mio tempo davanti a uno schermo nero con caratteri verdi (anche perchè non lo sono), non mi dispiace il <strong>refactoring</strong>, <strong>documentazione del codice</strong>, e le <strong>prove</strong> che sono tutt'altro che noiosi. Mi piace anche lavorare in settori diversi, come <strong>SEO</strong>, <strong>Accessibilità</strong> e <strong>Project Management</strong>. Ultimamente sto stato impegnato nell'apprendimento di <em>MongoDB</em>, <em>Perl</em>, <em>Python</em>, <em>Redis</em>, <em>XPath</em>, <em>Zend Framework</em>. Alcuni di loro per divertimento, altri per il lavoro.\n L'anno scorso sono stato totalmente impegnato in un grande progetto sviluppato utilizzando il framework <strong>Symfony</strong> (con <strong>Doctrine</strong>) e pratiche come test automatizzati. Ho esperienza di <strong>sviluppo agile</strong> perchè abbiamo implementato alcune delle tecniche agili (<em>pianificazione dell'iterazione</em>, <em>test-first</em>, <em>proprietà collettiva del codice</em> e così via). Ho avuto l'opportunità di mettere la mente e le mani direttamente nella gestione del progetto, seguendo diversi aspetti del ciclo di vita del progetto. Giusto per passione, curiosità e interesse ho creato <strong>Bonzai</strong> (precedentemente chiamato phpGuardian), uno strumento open-source per la codifica dei progetti PHP. Questo mi ha tenuto coinvolto nel corso degli anni molto sullo studio del core di PHP, nella scrittura di un'estensione personalizzata in C e nell'analisi del codice sorgente."
    },
    "interest": {
        "en_GB": ["Programming", "Swimming", "Snowboarding"],
        "it_IT": ["Programmazione", "Nuoto", "Snowboard"]
    },
    "location": {
        "postal_code": "NW2",
        "city": {
            "en_GB": "London",
            "it_IT": "Londra"
        },
        "coordinates": "51.558423,-0.212517",
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
        "uk": "+44 07831192297"
    }
});

/** language records **/
db.getCollection("language").insert({
    "_id": ObjectId("4fc7b632f7c5e27a69b8d7ac"),
    "code": "en_GB",
    "native": 0,
    "knowledge": {
        "listening":          "A2",
        "reading":            "B1",
        "spoken interaction": "A2",
        "spoken production":  "A2",
        "writing":            "A2"
    },
    "language": {
        "en_GB": "English",
        "it_IT": "Inglese"
    }
});
db.getCollection("language").insert({
    "_id": ObjectId("4fc7b632f7c5e27a69b8d7ab"),
    "code": "it_IT",
    "native": 1,
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
    }
});

/** skill records **/
db.getCollection("skill").insert({
    "_id": ObjectId("4fc7b63df7c5e27a69b8d7ad"),
    "name": {
        "en_GB": "Methodologies",
        "it_IT": "Metodologie"
    },
    "list": [
        {
            "name": {
                "en_GB": "Waterfall Model",
                "it_IT": "Modello a Cascata"
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
                "en_GB": "eXtreme Programming",
                "it_IT": "eXtreme Programming"
            },
            "proficiency": "beginner"
        }
    ]
});
db.getCollection("skill").insert({
    "_id": ObjectId("4fc7b646f7c5e27a69b8d7ae"),
    "name": {
        "en_GB": "Techniques",
        "it_IT": "Tecniche"
    },
    "list": [
        {
            "name": {
                "en_GB": "Pair Programming",
                "it_IT": "Programmazione in Coppia"
            },
            "proficiency": "advanced"
        },
        {
            "name": {
                "en_GB": "Unit and Functional Testing",
                "it_IT": "Test Unitari e Funzionali"
            },
            "proficiency": "intermediate"
        },
        {
            "name": {
                "en_GB": "Automated Builds",
                "it_IT": "Build Automatizzate"
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
                "en_GB": "Pomodoro Technique",
                "it_IT": "Tecnica del Pomodoro"
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
                "en_GB": "Code Coverage",
                "it_IT": "Copertura del Codice"
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
                "en_GB": "Static Code Analysis",
                "it_IT": "Analisi Statica del Codice"
            },
            "proficiency": "advanced"
        }
    ]
});
db.getCollection("skill").insert({
    "_id": ObjectId("4fc7b64ef7c5e27a69b8d7af"),
    "name": {
        "en_GB": "Technologies",
        "it_IT": "Tecnologie"
    },
    "list": [
        {
            "name":        "JavaScript",
            "proficiency": "advanced"
        },
        {
            "name":        "PHP",
            "proficiency": "expert"
        },
        {
            "name":        "MySQL",
            "proficiency": "advanced"
        },
        {
            "name":        "PostgreSQL",
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
            "name":        "Oracle",
            "proficiency": "beginner"
        },
        {
            "name":        "XML",
            "proficiency": "intermediate"
        },
        {
            "name":        "Redis",
            "proficiency": "beginner"
        },
        {
            "name":        "MongoDB",
            "proficiency": "beginner"
        },
        {
            "name":        "Python",
            "proficiency": "beginner"
        },
        {
            "name":        "C",
            "proficiency": "beginner"
        },
        {
            "name":        "ASP",
            "proficiency": "beginner"
        },
        {
            "name":        "ASP.net",
            "proficiency": "beginner"
        }
    ]
});
db.getCollection("skill").insert({
    "_id": ObjectId("4fc7b656f7c5e27a69b8d7b0"),
    "name": {
        "en_GB": "Tools",
        "it_IT": "Strumenti"
    },
    "list": [
        {
            "name":        "Prototype",
            "proficiency": "intermediate"
        },
        {
            "name":        "jQuery",
            "proficiency": "advanced"
        },
        {
            "name":        "Wordpress",
            "proficiency": "intermediate"
        },
        {
            "name":        "Zend Framework",
            "proficiency": "beginner"
        },
        {
            "name":        "Joomla",
            "proficiency": "advanced"
        },
        {
            "name":        "CVS",
            "proficiency": "intermediate"
        },
        {
            "name":        "SVN",
            "proficiency": "advanced"
        },
        {
            "name":        "GIT",
            "proficiency": "intermediate"
        },
        {
            "name":        "FastESP",
            "proficiency": "beginner"
        },
        {
            "name":        "Jira",
            "proficiency": "advanced"
        },
        {
            "name":        "GreenHopper",
            "proficiency": "beginner"
        },
        {
            "name":        "Symfony",
            "proficiency": "advanced"
        },
        {
            "name":        "Silex",
            "proficiency": "intermediate"
        },
        {
            "name":        "Hudson",
            "proficiency": "intermediate"
        },
        {
            "name":        "Alfresco",
            "proficiency": "beginner"
        },
        {
            "name":        "cUnit",
            "proficiency": "beginner"
        },
        {
            "name":        "phpUnit",
            "proficiency": "intermediate"
        },
        {
            "name":        "Automake",
            "proficiency": "beginner"
        },
        {
            "name":        "Splint",
            "proficiency": "beginner"
        },
        {
            "name":        "Jenkins",
            "proficiency": "intermediate"
        },
        {
            "name":        "Sonar",
            "proficiency": "beginner"
        },
        {
            "name":        "Mantis",
            "proficiency": "intermediate"
        }
    ]
});

/** system.indexes records **/
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
