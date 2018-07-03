<?php


    $_options = [
//      keyname, section, datatype, label, value, ?is_hidden
      ['currency', 1, 'enum', null, 'USD|GBP|EUR|RUB|BYN::BYN'],
        ['email', 1, 'string', null, ''],
        ['children_enabled', 1, 'enum', 'No|Yes', '0|1::1', true],
        ['hotel_name', 1, 'string', null, ''],
        ['hotel_logo', 1, 'string', null, ''],
        ['address', 1, 'string', null, ''],
        ['telephone', 1, 'string', null, ''],
        ['terms_and_conditions', 1, 'string', null, ''],
        ['privacy_policy', 1, 'string', null, ''],
        ['css', 1, 'string', null, ''],
    ];

    return $_options;