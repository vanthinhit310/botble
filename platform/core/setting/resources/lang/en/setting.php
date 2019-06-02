<?php

return [
    'title'                        => 'Settings',
    'email_setting_title'          => 'Email settings',
    'general'                      =>
        [
            'theme'                                 => 'Theme',
            'description'                           => 'Setting site information',
            'title'                                 => 'General',
            'general_block'                         => 'General Information',
            'rich_editor'                           => 'Rich Editor',
            'site_title'                            => 'Site title',
            'admin_email'                           => 'Admin Email',
            'seo_block'                             => 'SEO Configuration',
            'seo_title'                             => 'SEO Title',
            'seo_description'                       => 'SEO Description',
            'webmaster_tools_block'                 => 'Google Webmaster Tools',
            'google_site_verification'              => 'Google site verification',
            'show_admin_bar'                        => 'Show admin bar (When admin logged in, still show admin bar in website) ?',
            'placeholder'                           => [
                'site_title'               => 'Site Title (maximum 120 characters)',
                'admin_email'              => 'Admin Email',
                'seo_title'                => 'SEO Title (maximum 120 characters)',
                'seo_description'          => 'SEO Description (maximum 120 characters)',
                'google_analytics'         => 'Google Analytics',
                'google_site_verification' => 'Google Site Verification',
            ],
            'cache_admin_menu'                      => 'Cache admin menu?',
            'enable_send_error_reporting_via_email' => 'Enable to send error reporting via email?',
            'optimize_page_speed'                   => 'Optimize page speed (minify HTML output, inline CSS, remove comments ..)',
            'time_zone'                             => 'Timezone',
            'default_admin_theme'                   => 'Default admin theme',
            'enable_change_admin_theme'             => 'Enable change admin theme?',
            'enable_multi_language_in_admin'        => 'Enable multi language in admin area?',
            'enable'                                => 'Enable',
            'disable'                               => 'Disable',
            'enable_cache'                          => 'Enable cache?',
            'cache_time'                            => 'Cache time',
            'cache_time_site_map'                   => 'Cache Time Site map',
            'admin_logo'                            => 'Admin logo',
            'admin_title'                           => 'Admin title',
            'admin_title_placeholder'               => 'Title show to tab of browser',
            'cache_block'                           => 'Cache',
            'admin_appearance_title'                => 'Admin appearance',
            'admin_appearance_description'          => 'Setting admin appearance such as editor, admin bar, language',
            'seo_block_description'                 => 'Setting site title, site meta description, site keyword for optimize SEO',
            'webmaster_tools_description'           => 'Google Webmaster Tools (GWT) is free software that helps you manage the technical side of your website',
            'cache_description'                     => 'Config cache for system for optimize speed',
            'yes'                                   => 'Yes',
            'no'                                    => 'No',
            'show_on_front'                         => 'Your homepage displays',
            'select'                                => '— Select —',
            'show_site_name'                        => 'Show site name after page title, separate with "-"?',
        ],
    'email'                        => [
        'subject'                     => 'Subject',
        'content'                     => 'Content',
        'title'                       => 'Setting for email template',
        'description'                 => 'Email template using HTML & system variables.',
        'reset_to_default'            => 'Reset to default',
        'back'                        => 'Back to settings',
        'reset_success'               => 'Reset back to default successfully',
        'confirm_reset'               => 'Confirm reset email template?',
        'confirm_message'             => 'Do you really want to reset this email template to default?',
        'continue'                    => 'Continue',
        'sender_name'                 => 'Sender name',
        'sender_name_placeholder'     => 'Name',
        'sender_email'                => 'Sender email',
        'driver'                      => 'Driver',
        'port'                        => 'Port',
        'port_placeholder'            => 'Ex: 587',
        'host'                        => 'Host',
        'host_placeholder'            => 'Ex: smtp.gmail.com',
        'username'                    => 'Username',
        'username_placeholder'        => 'Username to login to mail server',
        'password'                    => 'Password',
        'password_placeholder'        => 'Password to login to mail server',
        'encryption'                  => 'Encryption',
        'mail_gun_domain'             => 'Domain',
        'mail_gun_domain_placeholder' => 'Domain',
        'mail_gun_secret'             => 'Secret',
        'mail_gun_secret_placeholder' => 'Secret',
        'template_title'              => 'Email templates',
        'template_description'        => 'Base templates for all emails',
        'template_header'             => 'Email template header',
        'template_header_description' => 'Template for header of emails',
        'template_footer'             => 'Email template footer',
        'template_footer_description' => 'Template for footer of emails',
    ],
    'media'                        => [
        'title'              => 'Media',
        'driver'             => 'Driver',
        'description'        => 'Settings for media',
        'aws_access_key_id'  => 'AWS Access Key ID',
        'aws_secret_key'     => 'AWS Secret Key',
        'aws_default_region' => 'AWS Default Region',
        'aws_bucket'         => 'AWS Bucket',
        'aws_url'            => 'AWS URL',
    ],
    'social'=>[
        'title' => 'Social Setting',
        'description' => 'Setting for social information',
        'fb' => 'Facebook'
    ],
    'slide'=>[
        'title' => 'Slide Setting',
        'description' => 'Setting slide home page [Best size: 955x832]',
        'slide_title' => 'Add slide',
    ],
    'editor'=>[
        'title' => 'Editor Setting',
        'description' => 'Setting editor block',
        'editor_des' => 'Description',
        'js' => 'Javascript',
        'lar' => 'Laravel',
        'css' => 'Css',
        'ruby' => 'Ruby on Rails',

    ],
    'field_type_not_exists'        => 'This field type does not exist',
    'save_settings'                => 'Save settings',
    'template'                     => 'Template',
    'description'                  => 'Description',
    'enable'                       => 'Enable',
    'send'                         => 'Send',
    'test_email_description'       => 'To send test email, please make sure you are updated configuration to send mail!',
    'test_email_input_placeholder' => 'Enter the email which you want to send test email.',
    'test_email_modal_title'       => 'Send a test email',
    'test_send_mail'               => 'Send test mail',
];
