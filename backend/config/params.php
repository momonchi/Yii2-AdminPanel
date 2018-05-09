<?php
return [
    'adminEmail' => 'momonchi.main@gmail.com',
    'access_pages' => [ "AdminUsers" => [
                                              "Admin" => [  
                                                    // 1 -30
                                                    ["1", "admin/index", "View Admin Users List"] ,
                                                    ["2", "admin/create", "Create Admin User"] ,
                                                    ["3", "admin/view", "View Admin User Info"] ,
                                                    ["4", "admin/userpasswordchange", "Change Admin User Password"] , 
                                                    ["5", "adminrole/index", "View Roles List"] , 
                                                    ["6", "adminrole/create", "Create Roles"] , 
                                                    ["7", "adminrole/view", "View Roles"] , 
                                              ],
                                              "Site" => [
                                                    // 151-200 
                                                    ["151", "site/index", "View Site"] ,
                                              ],
                                              "System Settings" => [
                                                    // 201-220 
                                                    ["201", "systemsettings/index", "System Settings"] ,
                                                    ["202", "systemsettings/index", "System Settings Update"] ,
                                              ],
                                         ],  
                 //**My Account (Back-end)
                        "MyAccount" => [
                                            ["1", "admin/passchange", "Change My Password"] ,
                                        ],
                        "MyAccount" => [
                                            ["1", "admin/passchange", "Change My Password"] ,
                                        ]
                      ],
    ];
