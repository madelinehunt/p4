# python script to generate dummy data for my seeders

import secrets
import random

def gen_turker():
    final = [];

    #constants
    gender_choices = [
        'Male',
        'Female',
        'Non-binary',
        'Decline'
    ]
    race_choices = [
        'American Indian or Alaska Native',
        'Asian',
        'Black or African-American',
        'Native Hawaiian or Other Pacific Islander',
        'White',
        'Other',
        'Multi-ethnic',
        'Decline',
    ]
    ethn_choices = [
        'Hispanic',
        'Not Hispanic',
        'Decline',
    ]

    #id_code
    id = 'A'
    id+=secrets.token_hex(13)
    id = id.upper()
    final.append(id)

    #participant_type
    final.append('mturk')

    #gender
    final.append(random.sample(gender_choices,1)[0])

    #race
    final.append(random.sample(race_choices,1)[0])

    #ethnicity
    final.append(random.sample(ethn_choices,1)[0])

    #age
    final.append(random.randint(18,45))

    return final

def gen_relationship(type):
    if type=='mturk':
        p_id_codes = [
            'AF4628D2C5B42A',
            'AEA21EC1E98EE5',
            'AD119EEB18C8B7',
            'AB40AA84E31024',
            'AADF29CA176DB3',
            'AAC6BCE0948085',
            'A7995LF5DX6PP0',
            'A687JG7V7RY3PY',
            'A4DDEFB1B7033F',
            'A4229VMGWUK9EI',
            'A31453B576A85F',
            'A246564E1F8402',
            'A1D2OLQTNLZL91',
            'A11810C6FC6B88',
            'A05F30D7A95772',
        ]

        study_names = [
            'nh/behavioral1',
            'nh/behavioral2',
            'nh/behavioral3',
        ]

    else:
        p_id_codes = [
            '62629337',
            '45672333',
            '20144177',
            '12190301',
        ]

        study_names = [
            'mc/games1',
            'mc/games2'
        ]

    relationships = [{},{}]
    for p in p_id_codes:
        first_study = random.sample(study_names,1)[0]
        others = [x for x in study_names if x != first_study]

        relationships[0][p] = first_study
        relationships[1][p] = random.sample(others,1)[0]

    return relationships
