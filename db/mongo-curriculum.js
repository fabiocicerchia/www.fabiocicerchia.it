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
        "url": "http:\/\/www.british-study.com",
        "location": {
            "address": "Hannah House, 13-16 Manchester Street",
            "cap": "W1U 4DJ",
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
        "end": ISODate("2012-04-27T00:00:00"),
        "hours": 80
    },
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
            "Parlato",
            "Ascolto"
        ]
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
        "url": "http:\/\/www.fermifrascati.it\/",
        "location": {
            "address": "Via Cesare Minardi, 14",
            "cap": "00044",
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
        "end": ISODate("2005-07-05T00:00:00"),
        "hours": 5676
    },
    "activities": {
        "en_GB": [
            "Italian language and literature",
            "History",
            "Foreign language (English)",
            "", /* TODO: TRANSLATE */
            "", /* TODO: TRANSLATE */
            "Mathematics",
            "", /* TODO: TRANSLATE */
            "", /* TODO: TRANSLATE */
            "", /* TODO: TRANSLATE */
            "", /* TODO: TRANSLATE */
            "", /* TODO: TRANSLATE */
            "Calculus of probability, Statistics, Operative Research",
            "Electronics",
            "Generic Computer Science",
            "", /* TODO: TRANSLATE */
            "" /* TODO: TRANSLATE */
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
    }
});
db.getCollection("education").insert({
    "_id": ObjectId("4fc7b3faf7c5e27a69b8d7a0"),
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
        "end": ISODate("2005-12-19T00:00:00"),
        "hours": 5
    },
    "institute": {
        "name": "AICA",
        "url": "http:\/\/www.aicanet.it",
        "location": {
            "cap": "00012",
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
    "_id": ObjectId("4fc7b402f7c5e27a69b8d7a1"),
    "activities": {
        "en_GB": [
            "CIW Associate",
            "CIW Application Developer",
            "At least 2 years of work experience"
        ],
        "it_IT": [
            /* TODO: TRANSLATE */
        ]
    },
    "date": {
        "start": ISODate("2011-04-27T00:00:00"),
        "end": ISODate("2011-04-27T00:00:00")
    },
    "institute": {
        "name": "IWA",
        "url": "http:\/\/www.iwanet.org"
    },
    "title": {
        "en_GB": "IWA Ceritified Web Professional Application Developer",
        "it_IT": "" /* TODO: TRANSLATE */
    }
});
db.getCollection("education").insert({
    "_id": ObjectId("4fc7b3f2f7c5e27a69b8d79f"),
    "activities": {
        "en_GB": [
            "Fundamentals of CGI Using Perl",
            "Dynamic Server Pages"
        ],
        "it_IT": [
            /* TODO: TRANSLATE */
        ]
    },
    "date": {
        "start": ISODate("2011-02-08T00:00:00"),
        "end": ISODate("2011-02-08T00:00:00")
    },
    "institute": {
        "name": "CIW Prometric Test Center 'Finsa Tech S.r.l.'",
        "location": {
            "address": "Via dei Gracchi, 209",
            "cap": "00192",
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
        "it_IT": "" /* TODO: TRANSLATE */
    }
});
db.getCollection("education").insert({
    "_id": ObjectId("4fc7b3eaf7c5e27a69b8d79e"),
    "activities": {
        "en_GB": [
            "Internet Business Foundation",
            "Site Development Foundation",
            "Network Technology Foundation"
        ],
        "it_IT": [
            /* TODO: TRANSLATE */
        ]
    },
    "date": {
        "start": ISODate("2009-09-23T00:00:00"),
        "end": ISODate("2009-09-23T00:00:00")
    },
    "institute": {
        "name": "CIW Prometric Test Center 'Atrak S.r.l.'",
        "location": {
            "address": "Via Valentino Mazzola, 66",
            "cap": "00142",
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
            /* TODO: TRANSLATE */
        ]
    },
    "date": {
        "start": ISODate("2008-06-25T00:00:00"),
        "end": ISODate("2008-06-25T00:00:00")
    },
    "institute": {
        "name": "Zend Pearson Vue Authorised Test Center 'IPSIA Carlo Cattaneo'",
        "location": {
            "address": "Via Antonio Pisano, 9",
            "cap": "00142",
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

/** experience records **/
db.getCollection("experience").insert({
    "_id": ObjectId("4fc7b550f7c5e27a69b8d7a3"),
    "role": {
        "en_GB": "Web \/ Software Developer",
        "it_IT": "" /* TODO: TRANSLATE */
    },
    "company": {
        "name": "ADQ S.p.A.",
        "location": {
            "address": "Via Barnaba Tortolini, 5",
            "cap": "00197",
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
        "end": ISODate("2007-12-31T00:00:00")
    },
    "description": {
        "en_GB": "Design and development of some web sites, applications web-based and desktop.",
        "it_IT": ""
    },
    "activities": {
        "en_GB": [
            /* TODO: TBW */
        ],
        "it_IT": [
            /* TODO: TBW */
        ]
    },
    "projects": [
        {
            "name": "StockInformatica",
            "date": {
                "start": ISODate("2012-05-24T00:00:00"),
                "end": ISODate("2012-12-31T00:00:00")
            },
            "role": {
                "en_GB": "", /* TODO: TBW */
                "it_IT": "" /* TODO: TBW */
            },
            "description": {
                "en_GB": "", /* TODO: TBW */
                "it_IT": "" /* TODO: TBW */
            },
            "technologies": [
                /* TODO: TBW */
            ],
            "tools": [
                /* TODO: TBW */
            ]
        },
        {
            "name": "ItalianCamper",
            "date": {
                "start": ISODate("2012-05-24T00:00:00"),
                "end": ISODate("2012-12-31T00:00:00")
            },
            "role": {
                "en_GB": "", /* TODO: TBW */
                "it_IT": "" /* TODO: TBW */
            },
            "description": {
                "en_GB": "", /* TODO: TBW */
                "it_IT": "" /* TODO: TBW */
            },
            "technologies": [
                /* TODO: TBW */
            ],
            "tools": [
                /* TODO: TBW */
            ]
        },
        {
            "name": "NoPayZone",
            "date": {
                "start": ISODate("2012-07-30T00:00:00"),
                "end": ISODate("2012-08-31T00:00:00")
            },
            "role": {
                "en_GB": "", /* TODO: TBW */
                "it_IT": "" /* TODO: TBW */
            },
            "description": {
                "en_GB": "", /* TODO: TBW */
                "it_IT": "" /* TODO: TBW */
            },
            "technologies": [
                /* TODO: TBW */
            ],
            "tools": [
                /* TODO: TBW */
            ]
        }
    ],
    "methodologies": {
        "Waterfall Model": {
            "months": 8
        }
    },
    "technologies": {
        "PHP": {
            "months": 8
        },
        "ASP": {
            "months": 8
        },
        "MySQL": {
            "months": 8
        },
        "Visual Basic": {
            "months": 4
        }
    },
    "tools": {
        "osCommerce": {
            "months": 8
        },
        "Wordpress": {
            "months": 4
        }
    }
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
            "cap": "00036",
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
        "end": ISODate("2006-10-02T00:00:00")
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
            "cap": "00036",
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
        "end": ISODate("2005-10-01T00:00:00")
    }
});
db.getCollection("experience").insert({
    "_id": ObjectId("4fc7b57df7c5e27a69b8d7a6"),
    "role": {
        "en_GB": "LAMP \/ PHP Developer",
        "it_IT": "Sviluppatore LAMP \/ PHP"
    },
    "company": {
        "name": "FusePump Limited",
        "url": "http:\/\/www.fusepump.com",
        "location": {
            "address": "Lower Ground Floor, 20-23 Greville Street",
            "cap": "EC1N 8SS",
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
    "activities": {
        "en_GB": [
            /* TODO: TBW */
        ],
        "it_IT": [
            /* TODO: TBW */
        ]
    },
    "projects": [
        /* TODO: TBW */
    ],
    "methodologies": [
        /* TODO: TBW */
    ],
    "techniques": [
        /* TODO: TBW */
    ],
    "technologies": {
        "JavaScript": {
            "months": 0 /* TODO: TBW */
        },
        "PHP": {
            "months": 0 /* TODO: TBW */
        },
        "MySQL": {
            "months": 0 /* TODO: TBW */
        },
        "XML": {
            "months": 0 /* TODO: TBW */
        },
        "Redis": {
            "months": 0 /* TODO: TBW */
        },
        "MongoDB": {
            "months": 0 /* TODO: TBW */
        }
    },
    "tools": {
        "SVN": {
            "months": 0 /* TODO: TBW */
        },
        "Jira": {
            "months": 0 /* TODO: TBW */
        },
        "GreenHopper": {
            "months": 0 /* TODO: TBW */
        },
        "Zend Framework": {
            "months": 0 /* TODO: TBW */
        }
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
        "url": "http:\/\/www.populis.com",
        "location": {
            "address": "Via Cristoforo Colombo, 112",
            "cap": "001947",
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
        "end": ISODate("2010-06-18T00:00:00")
    },
    "methodologies": {
        "Waterfall Model": {
            "months": 0 /* TODO: TBW */
        }
    },
    "projects": [
        /* TODO: TBW */
    ],
    "techniques": {
        "Pair Programming": {
            "months": 30
        },
        "Unit and Functional Testing": {
            "months": 24
        }
    },
    "technologies": {
        "JavaScript": {
            "months": 30
        },
        "PHP": {
            "months": 30
        },
        "MySQL": {
            "months": 30
        },
        "PostgreSQL": {
            "months": 12
        },
        "Python": {
            "months": 6
        }
    },
    "tools": {
        "Prototype": {
            "months": 12
        },
        "jQuery": {
            "months": 12
        },
        "Wordpress": {
            "months": 18
        },
        "Zend Framework": {
            "months": 6
        },
        "Joomla": {
            "months": 6
        },
        "CVS": {
            "months": 30
        },
        "SVN": {
            "months": 30
        },
        "FastESP": {
            "months": 6
        }
    }
});
db.getCollection("experience").insert({
    "_id": ObjectId("4fc7b5bbf7c5e27a69b8d7a8"),
    "role": {
        "en_GB": "Web Developer",
        "it_IT": "Sviluppatore Web"
    },
    "company": {
        "name": "Dnsee (Interactive Thinking S.r.l.)",
        "url": "http:\/\/www.dnsee.com",
        "location": {
            "address": "Via Flaminia Vecchia, 495",
            "cap": "00191",
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
        "end": ISODate("2012-03-30T00:00:00")
    },
    "activities": {
        "en_GB": [
            /* TODO: TBW */
        ],
        "it_IT": [
            /* TODO: TBW */
        ]
    },
    "projects": [
        {
            "name": "Samsung S Galaxy",
            "date": {
                "start": ISODate("2010-06-21T00:00:00"),
                "end": ISODate("2012-10-01T00:00:00")
            },
            "role": {
                "en_GB": "", /* TODO: TBW */
                "it_IT": "" /* TODO: TBW */
            },
            "description": {
                "en_GB": "", /* TODO: TBW */
                "it_IT": "" /* TODO: TBW */
            },
            "technologies": [
                /* TODO: TBW */
            ],
            "tools": [
                /* TODO: TBW */
            ]
        },
        {
            "name": "Policlinic Campus Biomedical of Rome",
            "url": "http:\/\/www.policlinicocampusbiomedico.it",
            "date": {
                "start": ISODate("2010-07-28T00:00:00"),
                "end": ISODate("2011-12-01T00:00:00")
            },
            "role": {
                "en_GB": "", /* TODO: TBW */
                "it_IT": "" /* TODO: TBW */
            },
            "description": {
                "en_GB": "", /* TODO: TBW */
                "it_IT": "" /* TODO: TBW */
            },
            "activities": {
                "en_GB": [
                    /* TODO: TBW */
                ],
                "it_IT": [
                    /* TODO: TBW */
                ]
            },
            "technologies": [
                /* TODO: TBW */
            ],
            "tools": [
                /* TODO: TBW */
            ]
        },
        {
            "name": "San Raffaele",
            "url": "http:\/\/www.sanraffaele.it",
            "date": {
                "start": ISODate("2010-10-05T00:00:00"),
                "end": ISODate("2012-03-30T00:00:00")
            },
            "role": {
                "en_GB": "", /* TODO: TBW */
                "it_IT": "" /* TODO: TBW */
            },
            "description": {
                "en_GB": "", /* TODO: TBW */
                "it_IT": "" /* TODO: TBW */
            },
            "activities": {
                "en_GB": [
                    /* TODO: TBW */
                ],
                "it_IT": [
                    /* TODO: TBW */
                ]
            },
            "methodologies": [
                /* TODO: TBW */
            ],
            "techniques": [
                /* TODO: TBW */
            ],
            "technologies": [
                /* TODO: TBW */
            ],
            "tools": [
                /* TODO: TBW */
            ]
        }
    ],
    "methodologies": {
        "SCRUM": {
            "months": 9
        },
        "eXtreme Programming": {
            "months": 12
        }
    },
    "techniques": {
        "Automated Builds": {
            "months": 12
        },
        "Continuous Integration": {
            "months": 12
        },
        "Pair Programming": {
            "months": 21
        },
        "Pomodoro Technique": {
            "months": 21
        },
        "Unit and Functional Testing": {
            "months": 21
        },
        "User Stories & Planning Poker": {
            "months": 21
        }
    },
    "technologies": {
        "JavaScript": {
            "months": 21
        },
        "PHP": {
            "months": 21
        },
        "MySQL": {
            "months": 21
        },
        "SQLite": {
            "months": 12
        },
        "SQL Server": {
            "months": 5
        },
        "Oracle": {
            "months": 5
        }
    },
    "tools": {
        "jQuery": {
            "months": 21
        },
        "Symfony": {
            "months": 21
        },
        "Silex": {
            "months": 6
        },
        "Joomla": {
            "months": 6
        },
        "Wordpress": {
            "months": 6
        },
        "SVN": {
            "months": 21
        },
        "Jira": {
            "months": 21
        },
        "Hudson": {
            "months": 12
        },
        "Alfresco": {
            "months": 21
        }
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
            "cap": "00036",
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
        "end": -1
    },
    "description": {
        "en_GB": "Web sites development and implementation (showcase sites and custom web applications).\nFrom June 2006 development and project management of Bonzai (planning, design, development and maintaining).\nFrom August 2005 collaboration with the Art Director Jeroen Bertsch. Realization of showcase sites with Wordpress and customized systems.",
        "it_IT": "" /* TODO: TRANSLATE */
    },
    "projects": [
        {
            "name": "Bonzai",
            "url": "http:\/\/www.bonzai-project.org",
            "date": {
                "start": ISODate("2006-08-22T00:00:00"),
                "end": -1
            },
            "role": {
                "en_GB": "", /* TODO: TBW */
                "it_IT": "" /* TODO: TBW */
            },
            "description": {
                "en_GB": "", /* TODO: TBW */
                "it_IT": "" /* TODO: TBW */
            },
            "activities": {
                "en_GB": [
                    /* TODO: TBW */
                ],
                "it_IT": [
                    /* TODO: TBW */
                ]
            },
            "techniques": [
                /* TODO: TBW */
            ],
            "technologies": [
                /* TODO: TBW */
            ],
            "tools": [
                /* TODO: TBW */
            ]
        }
    ],
    "techniques": {
        "Automated Builds": {
            "months": 0 /* TODO: TBW */
        },
        "Code Coverage": {
            "months": 0 /* TODO: TBW */
        },
        "Continuous Integration": {
            "months": 0 /* TODO: TBW */
        },
        "Pomodoro Technique": {
            "months": 0 /* TODO: TBW */
        },
        "Profiling": {
            "months": 0 /* TODO: TBW */
        },
        "Source Code Analysis": {
            "months": 0 /* TODO: TBW */
        },
        "Unit and Functional Testing": {
            "months": 0 /* TODO: TBW */
        }
    },
    "technologies": {
        "JavaScript": {
            "months": 0 /* TODO: TBW */
        },
        "PHP": {
            "months": 0 /* TODO: TBW */
        },
        "MySQL": {
            "months": 0 /* TODO: TBW */
        },
        "SQLite": {
            "months": 0 /* TODO: TBW */
        },
        "C": {
            "months": 0 /* TODO: TBW */
        }
    },
    "tools": {
        "jQuery": {
            "months": 0 /* TODO: TBW */
        },
        "Prototype": {
            "months": 0 /* TODO: TBW */
        },
        "Wordpress": {
            "months": 0 /* TODO: TBW */
        },
        "Zend Framework": {
            "months": 0 /* TODO: TBW */
        },
        "Joomla": {
            "months": 0 /* TODO: TBW */
        },
        "Silex": {
            "months": 0 /* TODO: TBW */
        },
        "Symfony": {
            "months": 0 /* TODO: TBW */
        },
        "CVS": {
            "months": 0 /* TODO: TBW */
        },
        "GIT": {
            "months": 0 /* TODO: TBW */
        },
        "cUnit": {
            "months": 0 /* TODO: TBW */
        },
        "phpUnit": {
            "months": 0 /* TODO: TBW */
        },
        "Automake": {
            "months": 0 /* TODO: TBW */
        },
        "Splint": {
            "months": 0 /* TODO: TBW */
        },
        "Jenkins": {
            "months": 0 /* TODO: TBW */
        },
        "Sonar": {
            "months": 0 /* TODO: TBW */
        },
        "Mantis": {
            "months": 0 /* TODO: TBW */
        }
    }
});

/** information records **/
db.getCollection("information").insert({
    "_id": ObjectId("4fc7b628f7c5e27a69b8d7aa"),
    "birth_day": ISODate("1986-02-09T00:00:00"),
    "contacts": {
        "msn": "fabio.cicerchia@live.it",
        "skype": "fabio.cicerchia",
        "email": "info@fabiocicerchia.it"
    },
    "gender": {
        "en_GB": "male",
        "it_IT": "maschio",
    },
    "info": {
        "en_GB": "I'm a passionate Web Developer and a security maniac, always looking for new challenges and a never-ending know-how. Since 2003 I've always been focused on PHP and JS applications and I found the time to certificate myself as a PHP 5 Engineer, CIW Application Developer and IWA Web Professional; apart from these, I never forgot the basics: I'm an expert using bash and writing complex Regular Expressions. I'm interested and involved also on SEO, Accessibility and Project Management. Lately I'm mainly focused on in-depth study of MongoDB, Node.js and Python.\nIn the last years I've been daily committed on projects with the RAD framework Symfony, using practices like automated tests and always trying to use bleeding edge technologies and methods for my work. I also have on-the-battlefield experience about agile development, as, in DNSEE, we implemented some of the agile techniques (iteration planning, test-first, collective code ownership and so on).\nFor passion, curiosity and interest I've created Bonzai (formerly known as phpGuardian), an open-source tool for encoding the PHP projects.",
        "it_IT": "" /* TODO: TRANSLATE */
    },
    "interest": {
        "en_GB": [
            "Programming",
            "Swimming",
            "Snowboarding"
        ],
        "it_IT": [
            "Programmazione",
            "Nuoto",
            "Snowboard"
        ]
    },
    "location": {
        "cap": "NW6",
        "city": {
            "en_GB": "London",
            "it_IT": "Londra"
        },
        "country_code": "GB",
        "country": {
            "en_GB": "United Kingdom",
            "it_IT": "Regno Unito"
        }
    },
    "marital_status": "single",
    "name": {
        "first_name": "Fabio",
        "last_name": "Cicerchia"
    },
    "nationality": {
        "en_GB": "italian",
        "it_IT": "italiana"
    },
    "role": "Senior Web Developer",
    "social": {
        "facebook": "https:\/\/www.facebook.com\/fabio.cicerchia",
        "linkedin": "http:\/\/linkedin.com\/in\/fabiocicerchia",
        "github": "https:\/\/github.com\/fabiocicerchia",
        "twitter": "https:\/\/twitter.com\/fabiocicerchia"
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
        "listening": "A2",
        "reading": "B1",
        "spoken interaction": "A2",
        "spoken production": "A2",
        "writing": "A2"
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
        "listening": "C2",
        "reading": "C2",
        "spoken interaction": "C2",
        "spoken production": "C2",
        "writing": "C2"
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
            "name": "JavaScript",
            "proficiency": "advanced"
        },
        {
            "name": "PHP",
            "proficiency": "expert"
        },
        {
            "name": "MySQL",
            "proficiency": "advanced"
        },
        {
            "name": "PostgreSQL",
            "proficiency": "intermediate"
        },
        {
            "name": "SQLite",
            "proficiency": "intermediate"
        },
        {
            "name": "SQL Server",
            "proficiency": "beginner"
        },
        {
            "name": "Oracle",
            "proficiency": "beginner"
        },
        {
            "name": "XML",
            "proficiency": "intermediate"
        },
        {
            "name": "Redis",
            "proficiency": "beginner"
        },
        {
            "name": "MongoDB",
            "proficiency": "beginner"
        },
        {
            "name": "Python",
            "proficiency": "beginner"
        },
        {
            "name": "C",
            "proficiency": "beginner"
        },
        {
            "name": "ASP",
            "proficiency": "beginner"
        },
        {
            "name": "ASP.net",
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
            "name": "Prototype",
            "proficiency": "intermediate"
        },
        {
            "name": "jQuery",
            "proficiency": "advanced"
        },
        {
            "name": "Wordpress",
            "proficiency": "intermediate"
        },
        {
            "name": "Zend Framework",
            "proficiency": "beginner"
        },
        {
            "name": "Joomla",
            "proficiency": "advanced"
        },
        {
            "name": "CVS",
            "proficiency": "intermediate"
        },
        {
            "name": "SVN",
            "proficiency": "advanced"
        },
        {
            "name": "GIT",
            "proficiency": "intermediate"
        },
        {
            "name": "FastESP",
            "proficiency": "beginner"
        },
        {
            "name": "Jira",
            "proficiency": "advanced"
        },
        {
            "name": "GreenHopper",
            "proficiency": "beginner"
        },
        {
            "name": "Symfony",
            "proficiency": "advanced"
        },
        {
            "name": "Silex",
            "proficiency": "intermediate"
        },
        {
            "name": "Hudson",
            "proficiency": "intermediate"
        },
        {
            "name": "Alfresco",
            "proficiency": "beginner"
        },
        {
            "name": "cUnit",
            "proficiency": "beginner"
        },
        {
            "name": "phpUnit",
            "proficiency": "intermediate"
        },
        {
            "name": "Automake",
            "proficiency": "beginner"
        },
        {
            "name": "Splint",
            "proficiency": "beginner"
        },
        {
            "name": "Jenkins",
            "proficiency": "intermediate"
        },
        {
            "name": "Sonar",
            "proficiency": "beginner"
        },
        {
            "name": "Mantis",
            "proficiency": "intermediate"
        }
    ]
});

/** system.indexes records **/
db.getCollection("system.indexes").insert({
    "v": 1,
    "key": {"_id": 1},
    "ns": "curriculum.education",
    "name": "_id_"
});
db.getCollection("system.indexes").insert({
    "v": 1,
    "key": {"_id": 1},
    "ns": "curriculum.experience",
    "name": "_id_"
});
db.getCollection("system.indexes").insert({
    "v": 1,
    "key": {"_id": 1},
    "ns": "curriculum.information",
    "name": "_id_"
});
db.getCollection("system.indexes").insert({
    "v": 1,
    "key": {"_id": 1},
    "ns": "curriculum.skill",
    "name": "_id_"
});
db.getCollection("system.indexes").insert({
    "v": 1,
    "key": {"_id": 1},
    "ns": "curriculum.language",
    "name": "_id_"
});
