<div class="ec_admin_settings_input ec_admin_settings_live_payment_section ec_admin_settings_<?php if( get_option('ec_option_payment_process_method') == "firstdata" ){ ?>show<?php }else{?>hide<?php }?>" id="firstdata">
    <span><?php _e( 'Setup First Data PayEezy (E4)', 'wp-easycart-pro' ); ?></span>
    <div>
        <?php _e( 'Gateway ID', 'wp-easycart-pro' ); ?>
        <input name="ec_option_firstdatae4_exact_id"  id="ec_option_firstdatae4_exact_id" type="text" value="<?php echo get_option('ec_option_firstdatae4_exact_id'); ?>" />
    </div>
    <div>
        <?php _e( 'Gateway Password', 'wp-easycart-pro' ); ?>
        <input name="ec_option_firstdatae4_password"  id="ec_option_firstdatae4_password" type="text" value="<?php echo get_option('ec_option_firstdatae4_password'); ?>" />
    </div>
    <div>
        <?php _e( 'Key ID', 'wp-easycart-pro' ); ?>
        <input name="ec_option_firstdatae4_key_id"  id="ec_option_firstdatae4_key_id" type="text" value="<?php echo get_option('ec_option_firstdatae4_key_id'); ?>" />
    </div>
    <div>
        <?php _e( 'Hmac Key', 'wp-easycart-pro' ); ?>
        <input name="ec_option_firstdatae4_key"  id="ec_option_firstdatae4_key" type="text" value="<?php echo get_option('ec_option_firstdatae4_key'); ?>" />
    </div>
    <div>
        <?php _e( 'Language', 'wp-easycart-pro' ); ?>
        <select name="ec_option_firstdatae4_language" id="ec_option_firstdatae4_language">
            <option value="EN" <?php if (get_option('ec_option_firstdatae4_language') == "EN") echo ' selected'; ?>>EN</option>
            <option value="FR" <?php if (get_option('ec_option_firstdatae4_language') == "FR") echo ' selected'; ?>>FR</option>
            <option value="ES" <?php if (get_option('ec_option_firstdatae4_language') == "ES") echo ' selected'; ?>>ES</option>
        </select>
    </div>
    <div>
        <?php _e( 'Currency', 'wp-easycart-pro' ); ?>
        <select name="ec_option_firstdatae4_currency" id="ec_option_firstdatae4_currency">
            <option value="USD" <?php if (get_option('ec_option_firstdatae4_currency') == "USD") echo ' selected'; ?>><?php _e( 'U.S. Dollar', 'wp-easycart-pro' ); ?></option>
            <option value="CAD" <?php if (get_option('ec_option_firstdatae4_currency') == "CAD") echo ' selected'; ?>><?php _e( 'Canadian Dollar', 'wp-easycart-pro' ); ?></option>
            <option value="DEM" <?php if (get_option('ec_option_firstdatae4_currency') == "DEM") echo ' selected'; ?>><?php _e( 'German Mark', 'wp-easycart-pro' ); ?></option>
            <option value="CHF" <?php if (get_option('ec_option_firstdatae4_currency') == "CHF") echo ' selected'; ?>><?php _e( 'Swiss Franc', 'wp-easycart-pro' ); ?></option>
            <option value="GBP" <?php if (get_option('ec_option_firstdatae4_currency') == "GBP") echo ' selected'; ?>><?php _e( 'British Pound', 'wp-easycart-pro' ); ?></option>
            <option value="JPY" <?php if (get_option('ec_option_firstdatae4_currency') == "JPY") echo ' selected'; ?>><?php _e( 'Japanese Yen', 'wp-easycart-pro' ); ?></option>
            <option value="AFA" <?php if (get_option('ec_option_firstdatae4_currency') == "AFA") echo ' selected'; ?>><?php _e( 'Afghanistan Afghani', 'wp-easycart-pro' ); ?></option>
            <option value="ALL" <?php if (get_option('ec_option_firstdatae4_currency') == "ALL") echo ' selected'; ?>><?php _e( 'Albanian Lek', 'wp-easycart-pro' ); ?></option>
            <option value="DZD" <?php if (get_option('ec_option_firstdatae4_currency') == "DZD") echo ' selected'; ?>><?php _e( 'Algerian Dinar', 'wp-easycart-pro' ); ?></option>
            <option value="ADF" <?php if (get_option('ec_option_firstdatae4_currency') == "ADF") echo ' selected'; ?>><?php _e( 'Andorran Franc', 'wp-easycart-pro' ); ?></option>
            <option value="ADP" <?php if (get_option('ec_option_firstdatae4_currency') == "ADP") echo ' selected'; ?>><?php _e( 'Andorran Peseta', 'wp-easycart-pro' ); ?></option>
            <option value="AON" <?php if (get_option('ec_option_firstdatae4_currency') == "AON") echo ' selected'; ?>><?php _e( 'Angolan New Kwanza', 'wp-easycart-pro' ); ?></option>
            <option value="ARS" <?php if (get_option('ec_option_firstdatae4_currency') == "ARS") echo ' selected'; ?>><?php _e( 'Argentine Peso', 'wp-easycart-pro' ); ?></option>
            <option value="AWG" <?php if (get_option('ec_option_firstdatae4_currency') == "AWG") echo ' selected'; ?>><?php _e( 'Aruban Florin', 'wp-easycart-pro' ); ?></option>
            <option value="AUD" <?php if (get_option('ec_option_firstdatae4_currency') == "AUD") echo ' selected'; ?>><?php _e( 'Australian Dollar', 'wp-easycart-pro' ); ?></option>
            <option value="ATS" <?php if (get_option('ec_option_firstdatae4_currency') == "ATS") echo ' selected'; ?>><?php _e( 'Austrian Schilling', 'wp-easycart-pro' ); ?></option>
            <option value="BSD" <?php if (get_option('ec_option_firstdatae4_currency') == "BSD") echo ' selected'; ?>><?php _e( 'Bahamanian Dollar', 'wp-easycart-pro' ); ?></option>
            <option value="BHD" <?php if (get_option('ec_option_firstdatae4_currency') == "BHD") echo ' selected'; ?>><?php _e( 'Bahraini Dinar', 'wp-easycart-pro' ); ?></option>
            <option value="BDT" <?php if (get_option('ec_option_firstdatae4_currency') == "BDT") echo ' selected'; ?>><?php _e( 'Bangladeshi Taka', 'wp-easycart-pro' ); ?></option>
            <option value="BBD" <?php if (get_option('ec_option_firstdatae4_currency') == "BBD") echo ' selected'; ?>><?php _e( 'Barbados Dollar', 'wp-easycart-pro' ); ?></option>
            <option value="BEF" <?php if (get_option('ec_option_firstdatae4_currency') == "BEF") echo ' selected'; ?>><?php _e( 'Belgian Franc', 'wp-easycart-pro' ); ?></option>
            <option value="BZD" <?php if (get_option('ec_option_firstdatae4_currency') == "BZD") echo ' selected'; ?>><?php _e( 'Belize Dollar', 'wp-easycart-pro' ); ?></option>
            <option value="BMD" <?php if (get_option('ec_option_firstdatae4_currency') == "BMD") echo ' selected'; ?>><?php _e( 'Bermudian Dollar', 'wp-easycart-pro' ); ?></option>
            <option value="BTN" <?php if (get_option('ec_option_firstdatae4_currency') == "BTN") echo ' selected'; ?>><?php _e( 'Bhutan Ngultrum', 'wp-easycart-pro' ); ?></option>
            <option value="BOB" <?php if (get_option('ec_option_firstdatae4_currency') == "BOB") echo ' selected'; ?>><?php _e( 'Bolivian Boliviano', 'wp-easycart-pro' ); ?></option>
            <option value="BWP" <?php if (get_option('ec_option_firstdatae4_currency') == "BWP") echo ' selected'; ?>><?php _e( 'Botswana Pula', 'wp-easycart-pro' ); ?></option>
            <option value="BRL" <?php if (get_option('ec_option_firstdatae4_currency') == "BRL") echo ' selected'; ?>><?php _e( 'Brazilian Real', 'wp-easycart-pro' ); ?></option>
            <option value="BND" <?php if (get_option('ec_option_firstdatae4_currency') == "BND") echo ' selected'; ?>><?php _e( 'Brunei Dollar', 'wp-easycart-pro' ); ?></option>
            <option value="BGL" <?php if (get_option('ec_option_firstdatae4_currency') == "BGL") echo ' selected'; ?>><?php _e( 'Bulgarian Lev', 'wp-easycart-pro' ); ?></option>
            <option value="BIF" <?php if (get_option('ec_option_firstdatae4_currency') == "BIF") echo ' selected'; ?>><?php _e( 'Burundi Franc', 'wp-easycart-pro' ); ?></option>
            <option value="XOF" <?php if (get_option('ec_option_firstdatae4_currency') == "XOF") echo ' selected'; ?>><?php _e( 'CFA Franc BCEAO', 'wp-easycart-pro' ); ?></option>
            <option value="XAF" <?php if (get_option('ec_option_firstdatae4_currency') == "XAF") echo ' selected'; ?>><?php _e( 'CFA Franc BEAC', 'wp-easycart-pro' ); ?></option>
            <option value="KHR" <?php if (get_option('ec_option_firstdatae4_currency') == "KHR") echo ' selected'; ?>><?php _e( 'Cambodian Riel', 'wp-easycart-pro' ); ?></option>
            <option value="CVE" <?php if (get_option('ec_option_firstdatae4_currency') == "CVE") echo ' selected'; ?>><?php _e( 'Cape Verde Escudo', 'wp-easycart-pro' ); ?></option>
            <option value="KYD" <?php if (get_option('ec_option_firstdatae4_currency') == "KYD") echo ' selected'; ?>><?php _e( 'Cayman Islands Dollar', 'wp-easycart-pro' ); ?></option>
            <option value="CLP" <?php if (get_option('ec_option_firstdatae4_currency') == "CLP") echo ' selected'; ?>><?php _e( 'Chilean Peso', 'wp-easycart-pro' ); ?></option>
            <option value="CNY" <?php if (get_option('ec_option_firstdatae4_currency') == "CNY") echo ' selected'; ?>><?php _e( 'Chinese Yuan Renminbi', 'wp-easycart-pro' ); ?></option>
            <option value="COP" <?php if (get_option('ec_option_firstdatae4_currency') == "COP") echo ' selected'; ?>><?php _e( 'Colombian Peso', 'wp-easycart-pro' ); ?></option>
            <option value="KMF" <?php if (get_option('ec_option_firstdatae4_currency') == "KMF") echo ' selected'; ?>><?php _e( 'Comoros Franc', 'wp-easycart-pro' ); ?></option>
            <option value="CRC" <?php if (get_option('ec_option_firstdatae4_currency') == "CRC") echo ' selected'; ?>><?php _e( 'Costa Rican Colon', 'wp-easycart-pro' ); ?></option>
            <option value="HRK" <?php if (get_option('ec_option_firstdatae4_currency') == "HRK") echo ' selected'; ?>><?php _e( 'Croatian Kuna', 'wp-easycart-pro' ); ?></option>
            <option value="CYP" <?php if (get_option('ec_option_firstdatae4_currency') == "CYP") echo ' selected'; ?>><?php _e( 'Cyprus Pound', 'wp-easycart-pro' ); ?></option>
            <option value="CSK" <?php if (get_option('ec_option_firstdatae4_currency') == "CSK") echo ' selected'; ?>><?php _e( 'Czech Koruna', 'wp-easycart-pro' ); ?></option>
            <option value="DKK" <?php if (get_option('ec_option_firstdatae4_currency') == "DKK") echo ' selected'; ?>><?php _e( 'Danish Krone', 'wp-easycart-pro' ); ?></option>
            <option value="DJF" <?php if (get_option('ec_option_firstdatae4_currency') == "DJF") echo ' selected'; ?>><?php _e( 'Djibouti Franc', 'wp-easycart-pro' ); ?></option>
            <option value="DOP" <?php if (get_option('ec_option_firstdatae4_currency') == "DOP") echo ' selected'; ?>><?php _e( 'Dominican Peso', 'wp-easycart-pro' ); ?></option>
            <option value="NLG" <?php if (get_option('ec_option_firstdatae4_currency') == "NLG") echo ' selected'; ?>><?php _e( 'Dutch Guilder', 'wp-easycart-pro' ); ?></option>
            <option value="XEU" <?php if (get_option('ec_option_firstdatae4_currency') == "XEU") echo ' selected'; ?>><?php _e( 'ECU', 'wp-easycart-pro' ); ?></option>
            <option value="ECS" <?php if (get_option('ec_option_firstdatae4_currency') == "ECE") echo ' selected'; ?>><?php _e( 'Ecuador Sucre', 'wp-easycart-pro' ); ?></option>
            <option value="EGP" <?php if (get_option('ec_option_firstdatae4_currency') == "EGP") echo ' selected'; ?>><?php _e( 'Egyptian Pound', 'wp-easycart-pro' ); ?></option>
            <option value="SVC" <?php if (get_option('ec_option_firstdatae4_currency') == "SVC") echo ' selected'; ?>><?php _e( 'El Salvador Colon', 'wp-easycart-pro' ); ?></option>
            <option value="EEK" <?php if (get_option('ec_option_firstdatae4_currency') == "EEK") echo ' selected'; ?>><?php _e( 'Estonian Kroon', 'wp-easycart-pro' ); ?></option>
            <option value="ETB" <?php if (get_option('ec_option_firstdatae4_currency') == "ETB") echo ' selected'; ?>><?php _e( 'Ethiopian Birr', 'wp-easycart-pro' ); ?></option>
            <option value="EUR" <?php if (get_option('ec_option_firstdatae4_currency') == "EUR") echo ' selected'; ?>><?php _e( 'Euro', 'wp-easycart-pro' ); ?></option>
            <option value="FKP" <?php if (get_option('ec_option_firstdatae4_currency') == "FKP") echo ' selected'; ?>><?php _e( 'Falkland Islands Pound', 'wp-easycart-pro' ); ?></option>
            <option value="FJD" <?php if (get_option('ec_option_firstdatae4_currency') == "FJD") echo ' selected'; ?>><?php _e( 'Fiji Dollar', 'wp-easycart-pro' ); ?></option>
            <option value="FIM" <?php if (get_option('ec_option_firstdatae4_currency') == "FTM") echo ' selected'; ?>><?php _e( 'Finnish Markka', 'wp-easycart-pro' ); ?></option>
            <option value="FRF" <?php if (get_option('ec_option_firstdatae4_currency') == "FRF") echo ' selected'; ?>><?php _e( 'French Franc', 'wp-easycart-pro' ); ?></option>
            <option value="GMD" <?php if (get_option('ec_option_firstdatae4_currency') == "GMD") echo ' selected'; ?>><?php _e( 'Gambian Dalasi', 'wp-easycart-pro' ); ?></option>
            <option value="GHC" <?php if (get_option('ec_option_firstdatae4_currency') == "GHC") echo ' selected'; ?>><?php _e( 'Ghanaian Cedi', 'wp-easycart-pro' ); ?></option>
            <option value="GIP" <?php if (get_option('ec_option_firstdatae4_currency') == "GIP") echo ' selected'; ?>><?php _e( 'Gibraltar Pound', 'wp-easycart-pro' ); ?></option>
            <option value="XAU" <?php if (get_option('ec_option_firstdatae4_currency') == "XAU") echo ' selected'; ?>><?php _e( 'Gold (oz.)', 'wp-easycart-pro' ); ?></option>
            <option value="GRD" <?php if (get_option('ec_option_firstdatae4_currency') == "GRD") echo ' selected'; ?>><?php _e( 'Greek Drachma', 'wp-easycart-pro' ); ?></option>
            <option value="GTQ" <?php if (get_option('ec_option_firstdatae4_currency') == "GTQ") echo ' selected'; ?>><?php _e( 'Guatemalan Quetzal', 'wp-easycart-pro' ); ?></option>
            <option value="GNF" <?php if (get_option('ec_option_firstdatae4_currency') == "GNF") echo ' selected'; ?>><?php _e( 'Guinea Franc', 'wp-easycart-pro' ); ?></option>
            <option value="GYD" <?php if (get_option('ec_option_firstdatae4_currency') == "GYD") echo ' selected'; ?>><?php _e( 'Guyanan Dollar', 'wp-easycart-pro' ); ?></option>
            <option value="HTG" <?php if (get_option('ec_option_firstdatae4_currency') == "HTG") echo ' selected'; ?>><?php _e( 'Haitian Gourde', 'wp-easycart-pro' ); ?></option>
            <option value="HNL" <?php if (get_option('ec_option_firstdatae4_currency') == "HNL") echo ' selected'; ?>><?php _e( 'Honduran Lempira', 'wp-easycart-pro' ); ?></option>
            <option value="HKD" <?php if (get_option('ec_option_firstdatae4_currency') == "HKD") echo ' selected'; ?>><?php _e( 'Hong Kong Dollar', 'wp-easycart-pro' ); ?></option>
            <option value="HUF" <?php if (get_option('ec_option_firstdatae4_currency') == "HUF") echo ' selected'; ?>><?php _e( 'Hungarian Forint', 'wp-easycart-pro' ); ?></option>
            <option value="ISK" <?php if (get_option('ec_option_firstdatae4_currency') == "ISK") echo ' selected'; ?>><?php _e( 'Iceland Krona', 'wp-easycart-pro' ); ?></option>
            <option value="INR" <?php if (get_option('ec_option_firstdatae4_currency') == "INR") echo ' selected'; ?>><?php _e( 'Indian Rupee', 'wp-easycart-pro' ); ?></option>
            <option value="IDR" <?php if (get_option('ec_option_firstdatae4_currency') == "IDR") echo ' selected'; ?>><?php _e( 'Indonesian Rupiah', 'wp-easycart-pro' ); ?></option>
            <option value="IEP" <?php if (get_option('ec_option_firstdatae4_currency') == "IEP") echo ' selected'; ?>><?php _e( 'Irish Punt', 'wp-easycart-pro' ); ?></option>
            <option value="ILS" <?php if (get_option('ec_option_firstdatae4_currency') == "ILS") echo ' selected'; ?>><?php _e( 'Israeli New Shekel', 'wp-easycart-pro' ); ?></option>
            <option value="ITL" <?php if (get_option('ec_option_firstdatae4_currency') == "ITL") echo ' selected'; ?>><?php _e( 'Italian Lira', 'wp-easycart-pro' ); ?></option>
            <option value="JMD" <?php if (get_option('ec_option_firstdatae4_currency') == "JMD") echo ' selected'; ?>><?php _e( 'Jamaican Dollar', 'wp-easycart-pro' ); ?></option>
            <option value="JOD" <?php if (get_option('ec_option_firstdatae4_currency') == "JOD") echo ' selected'; ?>><?php _e( 'Jordanian Dinar', 'wp-easycart-pro' ); ?></option>
            <option value="KZT" <?php if (get_option('ec_option_firstdatae4_currency') == "KZT") echo ' selected'; ?>><?php _e( 'Kazakhstan Tenge', 'wp-easycart-pro' ); ?></option>
            <option value="KES" <?php if (get_option('ec_option_firstdatae4_currency') == "KES") echo ' selected'; ?>><?php _e( 'Kenyan Shilling', 'wp-easycart-pro' ); ?></option>
            <option value="KWD" <?php if (get_option('ec_option_firstdatae4_currency') == "KWD") echo ' selected'; ?>><?php _e( 'Kuwaiti Dinar', 'wp-easycart-pro' ); ?></option>
            <option value="LAK" <?php if (get_option('ec_option_firstdatae4_currency') == "LAK") echo ' selected'; ?>><?php _e( 'Lao Kip', 'wp-easycart-pro' ); ?></option>
            <option value="LVL" <?php if (get_option('ec_option_firstdatae4_currency') == "LVL") echo ' selected'; ?>><?php _e( 'Latvian Lats', 'wp-easycart-pro' ); ?></option>
            <option value="LSL" <?php if (get_option('ec_option_firstdatae4_currency') == "LSL") echo ' selected'; ?>><?php _e( 'Lesotho Loti', 'wp-easycart-pro' ); ?></option>
            <option value="LRD" <?php if (get_option('ec_option_firstdatae4_currency') == "LRD") echo ' selected'; ?>><?php _e( 'Liberian Dollar', 'wp-easycart-pro' ); ?></option>
            <option value="LTL" <?php if (get_option('ec_option_firstdatae4_currency') == "LTL") echo ' selected'; ?>><?php _e( 'Lithuanian Litas', 'wp-easycart-pro' ); ?></option>
            <option value="LUF" <?php if (get_option('ec_option_firstdatae4_currency') == "LUF") echo ' selected'; ?>><?php _e( 'Luxembourg Franc', 'wp-easycart-pro' ); ?></option>
            <option value="MOP" <?php if (get_option('ec_option_firstdatae4_currency') == "MOP") echo ' selected'; ?>><?php _e( 'Macau Pataca', 'wp-easycart-pro' ); ?></option>
            <option value="MGF" <?php if (get_option('ec_option_firstdatae4_currency') == "MGF") echo ' selected'; ?>><?php _e( 'Malagasy Franc', 'wp-easycart-pro' ); ?></option>
            <option value="MWK" <?php if (get_option('ec_option_firstdatae4_currency') == "MWK") echo ' selected'; ?>><?php _e( 'Malawi Kwacha', 'wp-easycart-pro' ); ?></option>
            <option value="MYR" <?php if (get_option('ec_option_firstdatae4_currency') == "MYR") echo ' selected'; ?>><?php _e( 'Malaysian Ringgit', 'wp-easycart-pro' ); ?></option>
            <option value="MVR" <?php if (get_option('ec_option_firstdatae4_currency') == "MVR") echo ' selected'; ?>><?php _e( 'Maldive Rufiyaa', 'wp-easycart-pro' ); ?></option>
            <option value="MTL" <?php if (get_option('ec_option_firstdatae4_currency') == "MRL") echo ' selected'; ?>><?php _e( 'Maltese Lira', 'wp-easycart-pro' ); ?></option>
            <option value="MRO" <?php if (get_option('ec_option_firstdatae4_currency') == "MRO") echo ' selected'; ?>><?php _e( 'Mauritanian Ouguiya', 'wp-easycart-pro' ); ?></option>
            <option value="MUR" <?php if (get_option('ec_option_firstdatae4_currency') == "MUR") echo ' selected'; ?>><?php _e( 'Mauritius Rupee', 'wp-easycart-pro' ); ?></option>
            <option value="MXN" <?php if (get_option('ec_option_firstdatae4_currency') == "MXN") echo ' selected'; ?>><?php _e( 'Mexican Peso', 'wp-easycart-pro' ); ?></option>
            <option value="MNT" <?php if (get_option('ec_option_firstdatae4_currency') == "MNT") echo ' selected'; ?>><?php _e( 'Mongolian Tugrik', 'wp-easycart-pro' ); ?></option>
            <option value="MAD" <?php if (get_option('ec_option_firstdatae4_currency') == "MAD") echo ' selected'; ?>><?php _e( 'Moroccan Dirham', 'wp-easycart-pro' ); ?></option>
            <option value="MZM" <?php if (get_option('ec_option_firstdatae4_currency') == "MZM") echo ' selected'; ?>><?php _e( 'Mozambique Metical', 'wp-easycart-pro' ); ?></option>
            <option value="MMK" <?php if (get_option('ec_option_firstdatae4_currency') == "MMK") echo ' selected'; ?>><?php _e( 'Myanmar Kyat', 'wp-easycart-pro' ); ?></option>
            <option value="ANG" <?php if (get_option('ec_option_firstdatae4_currency') == "ANG") echo ' selected'; ?>><?php _e( 'NL Antillian Guilder', 'wp-easycart-pro' ); ?></option>
            <option value="NAD" <?php if (get_option('ec_option_firstdatae4_currency') == "NAD") echo ' selected'; ?>><?php _e( 'Namibia Dollar', 'wp-easycart-pro' ); ?></option>
            <option value="NPR" <?php if (get_option('ec_option_firstdatae4_currency') == "NPR") echo ' selected'; ?>><?php _e( 'Nepalese Rupee', 'wp-easycart-pro' ); ?></option>
            <option value="NZD" <?php if (get_option('ec_option_firstdatae4_currency') == "NZD") echo ' selected'; ?>><?php _e( 'New Zealand Dollar', 'wp-easycart-pro' ); ?></option>
            <option value="NIO" <?php if (get_option('ec_option_firstdatae4_currency') == "NIO") echo ' selected'; ?>><?php _e( 'Nicaraguan Cordoba Oro', 'wp-easycart-pro' ); ?></option>
            <option value="NGN" <?php if (get_option('ec_option_firstdatae4_currency') == "NGN") echo ' selected'; ?>><?php _e( 'Nigerian Naira', 'wp-easycart-pro' ); ?></option>
            <option value="NOK" <?php if (get_option('ec_option_firstdatae4_currency') == "NOK") echo ' selected'; ?>><?php _e( 'Norwegian Kroner', 'wp-easycart-pro' ); ?></option>
            <option value="OMR" <?php if (get_option('ec_option_firstdatae4_currency') == "OMR") echo ' selected'; ?>><?php _e( 'Omani Rial', 'wp-easycart-pro' ); ?></option>
            <option value="PKR" <?php if (get_option('ec_option_firstdatae4_currency') == "PKR") echo ' selected'; ?>><?php _e( 'Pakistan Rupee', 'wp-easycart-pro' ); ?></option>
            <option value="XPD" <?php if (get_option('ec_option_firstdatae4_currency') == "XPD") echo ' selected'; ?>><?php _e( 'Palladium (oz.)', 'wp-easycart-pro' ); ?></option>
            <option value="PAB" <?php if (get_option('ec_option_firstdatae4_currency') == "PAB") echo ' selected'; ?>><?php _e( 'Panamanian Balboa', 'wp-easycart-pro' ); ?></option>
            <option value="PGK" <?php if (get_option('ec_option_firstdatae4_currency') == "PGK") echo ' selected'; ?>><?php _e( 'Papua New Guinea Kina', 'wp-easycart-pro' ); ?></option>
            <option value="PYG" <?php if (get_option('ec_option_firstdatae4_currency') == "PYG") echo ' selected'; ?>><?php _e( 'Paraguay Guarani', 'wp-easycart-pro' ); ?></option>
            <option value="PEN" <?php if (get_option('ec_option_firstdatae4_currency') == "PEN") echo ' selected'; ?>><?php _e( 'Peruvian Nuevo Sol', 'wp-easycart-pro' ); ?></option>
            <option value="PHP" <?php if (get_option('ec_option_firstdatae4_currency') == "PHP") echo ' selected'; ?>><?php _e( 'Philippine Peso', 'wp-easycart-pro' ); ?></option>
            <option value="XPT" <?php if (get_option('ec_option_firstdatae4_currency') == "XPT") echo ' selected'; ?>><?php _e( 'Platinum (oz.)', 'wp-easycart-pro' ); ?></option>
            <option value="PLN" <?php if (get_option('ec_option_firstdatae4_currency') == "PLN") echo ' selected'; ?>><?php _e( 'Polish Zloty', 'wp-easycart-pro' ); ?></option>
            <option value="PTE" <?php if (get_option('ec_option_firstdatae4_currency') == "PTE") echo ' selected'; ?>><?php _e( 'Portuguese Escudo', 'wp-easycart-pro' ); ?></option>
            <option value="QAR" <?php if (get_option('ec_option_firstdatae4_currency') == "QAR") echo ' selected'; ?>><?php _e( 'Qatari Rial', 'wp-easycart-pro' ); ?></option>
            <option value="ROL" <?php if (get_option('ec_option_firstdatae4_currency') == "ROL") echo ' selected'; ?>><?php _e( 'Romanian Leu', 'wp-easycart-pro' ); ?></option>
            <option value="RUB" <?php if (get_option('ec_option_firstdatae4_currency') == "RUB") echo ' selected'; ?>><?php _e( 'Russian Rouble', 'wp-easycart-pro' ); ?></option>
            <option value="WST" <?php if (get_option('ec_option_firstdatae4_currency') == "WST") echo ' selected'; ?>><?php _e( 'Samoan Tala', 'wp-easycart-pro' ); ?></option>
            <option value="STD" <?php if (get_option('ec_option_firstdatae4_currency') == "STD") echo ' selected'; ?>><?php _e( 'Sao Tome/Principe Dobra', 'wp-easycart-pro' ); ?></option>
            <option value="SAR" <?php if (get_option('ec_option_firstdatae4_currency') == "SAR") echo ' selected'; ?>><?php _e( 'Saudi Riyal', 'wp-easycart-pro' ); ?></option>
            <option value="SCR" <?php if (get_option('ec_option_firstdatae4_currency') == "SCR") echo ' selected'; ?>><?php _e( 'Seychelles Rupee', 'wp-easycart-pro' ); ?></option>
            <option value="SLL" <?php if (get_option('ec_option_firstdatae4_currency') == "SLL") echo ' selected'; ?>><?php _e( 'Sierra Leone Leone', 'wp-easycart-pro' ); ?></option>
            <option value="XAG" <?php if (get_option('ec_option_firstdatae4_currency') == "XAG") echo ' selected'; ?>><?php _e( 'Silver (oz.)', 'wp-easycart-pro' ); ?></option>
            <option value="SGD" <?php if (get_option('ec_option_firstdatae4_currency') == "SGD") echo ' selected'; ?>><?php _e( 'Singapore Dollar', 'wp-easycart-pro' ); ?></option>
            <option value="SKK" <?php if (get_option('ec_option_firstdatae4_currency') == "SKK") echo ' selected'; ?>><?php _e( 'Slovak Koruna', 'wp-easycart-pro' ); ?></option>
            <option value="SIT" <?php if (get_option('ec_option_firstdatae4_currency') == "SIT") echo ' selected'; ?>><?php _e( 'Slovenian Tolar', 'wp-easycart-pro' ); ?></option>
            <option value="SBD" <?php if (get_option('ec_option_firstdatae4_currency') == "SBD") echo ' selected'; ?>><?php _e( 'Solomon Islands Dollar', 'wp-easycart-pro' ); ?></option>
            <option value="ZAR" <?php if (get_option('ec_option_firstdatae4_currency') == "ZAR") echo ' selected'; ?>><?php _e( 'South African Rand', 'wp-easycart-pro' ); ?></option>
            <option value="KRW" <?php if (get_option('ec_option_firstdatae4_currency') == "KRW") echo ' selected'; ?>><?php _e( 'South-Korean Won', 'wp-easycart-pro' ); ?></option>
            <option value="ESP" <?php if (get_option('ec_option_firstdatae4_currency') == "ESP") echo ' selected'; ?>><?php _e( 'Spanish Peseta', 'wp-easycart-pro' ); ?></option>
            <option value="LKR" <?php if (get_option('ec_option_firstdatae4_currency') == "LKR") echo ' selected'; ?>><?php _e( 'Sri Lanka Rupee', 'wp-easycart-pro' ); ?></option>
            <option value="SHP" <?php if (get_option('ec_option_firstdatae4_currency') == "SHP") echo ' selected'; ?>><?php _e( 'St. Helena Pound', 'wp-easycart-pro' ); ?></option>
            <option value="SRG" <?php if (get_option('ec_option_firstdatae4_currency') == "SRG") echo ' selected'; ?>><?php _e( 'Suriname Guilder', 'wp-easycart-pro' ); ?></option>
            <option value="SZL" <?php if (get_option('ec_option_firstdatae4_currency') == "SZL") echo ' selected'; ?>><?php _e( 'Swaziland Lilangeni', 'wp-easycart-pro' ); ?></option>
            <option value="SEK" <?php if (get_option('ec_option_firstdatae4_currency') == "SEK") echo ' selected'; ?>><?php _e( 'Swedish Krona', 'wp-easycart-pro' ); ?></option>
            <option value="TWD" <?php if (get_option('ec_option_firstdatae4_currency') == "TWS") echo ' selected'; ?>><?php _e( 'Taiwan Dollar', 'wp-easycart-pro' ); ?></option>
            <option value="TZS" <?php if (get_option('ec_option_firstdatae4_currency') == "TZS") echo ' selected'; ?>><?php _e( 'Tanzanian Shilling', 'wp-easycart-pro' ); ?></option>
            <option value="THB" <?php if (get_option('ec_option_firstdatae4_currency') == "THB") echo ' selected'; ?>><?php _e( 'Thai Baht', 'wp-easycart-pro' ); ?></option>
            <option value="TOP" <?php if (get_option('ec_option_firstdatae4_currency') == "TOP") echo ' selected'; ?>><?php _e( 'Tonga Pa\'anga', 'wp-easycart-pro' ); ?></option>
            <option value="TTD" <?php if (get_option('ec_option_firstdatae4_currency') == "TTD") echo ' selected'; ?>><?php _e( 'Trinidad/Tobago Dollar', 'wp-easycart-pro' ); ?></option>
            <option value="TND" <?php if (get_option('ec_option_firstdatae4_currency') == "TND") echo ' selected'; ?>><?php _e( 'Tunisian Dinar', 'wp-easycart-pro' ); ?></option>
            <option value="TRL" <?php if (get_option('ec_option_firstdatae4_currency') == "TRL") echo ' selected'; ?>><?php _e( 'Turkish Lira', 'wp-easycart-pro' ); ?></option>
            <option value="UGS" <?php if (get_option('ec_option_firstdatae4_currency') == "UGS") echo ' selected'; ?>><?php _e( 'Uganda Shilling', 'wp-easycart-pro' ); ?></option>
            <option value="UAH" <?php if (get_option('ec_option_firstdatae4_currency') == "UAH") echo ' selected'; ?>><?php _e( 'Ukraine Hryvnia', 'wp-easycart-pro' ); ?></option>
            <option value="UYP" <?php if (get_option('ec_option_firstdatae4_currency') == "UYP") echo ' selected'; ?>><?php _e( 'Uruguayan Peso', 'wp-easycart-pro' ); ?></option>
            <option value="AED" <?php if (get_option('ec_option_firstdatae4_currency') == "AED") echo ' selected'; ?>><?php _e( 'Utd. Arab Emir. Dirham', 'wp-easycart-pro' ); ?></option>
            <option value="VUV" <?php if (get_option('ec_option_firstdatae4_currency') == "VUV") echo ' selected'; ?>><?php _e( 'Vanuatu Vatu', 'wp-easycart-pro' ); ?></option>
            <option value="VEB" <?php if (get_option('ec_option_firstdatae4_currency') == "VEB") echo ' selected'; ?>><?php _e( 'Venezuelan Bolivar', 'wp-easycart-pro' ); ?></option>
            <option value="VND" <?php if (get_option('ec_option_firstdatae4_currency') == "VND") echo ' selected'; ?>><?php _e( 'Vietnamese Dong', 'wp-easycart-pro' ); ?></option>
            <option value="YUN" <?php if (get_option('ec_option_firstdatae4_currency') == "YUN") echo ' selected'; ?>><?php _e( 'Yugoslav Dinar', 'wp-easycart-pro' ); ?></option>
            <option value="ZMK" <?php if (get_option('ec_option_firstdatae4_currency') == "ZMK") echo ' selected'; ?>><?php _e( 'Zambian Kwacha', 'wp-easycart-pro' ); ?></option>
          </select>
    </div>
    <div>
        <?php _e( 'Test Mode', 'wp-easycart-pro' ); ?>
        <select name="ec_option_firstdatae4_test_mode" id="ec_option_firstdatae4_test_mode">
            <option value="1" <?php if (get_option('ec_option_firstdatae4_test_mode') == 1) echo ' selected'; ?>><?php _e( 'Yes', 'wp-easycart-pro' ); ?></option>
            <option value="0" <?php if (get_option('ec_option_firstdatae4_test_mode') == 0) echo ' selected'; ?>><?php _e( 'No', 'wp-easycart-pro' ); ?></option>
        </select>
    </div>
    <div class="ec_admin_settings_input">
        <input type="submit" class="ec_admin_settings_simple_button" onclick="return ec_admin_save_firstdata_options( );" value="<?php _e( 'Save Options', 'wp-easycart-pro' ); ?>" />
    </div>
</div>