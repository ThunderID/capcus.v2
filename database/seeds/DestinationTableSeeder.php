<?php

use Illuminate\Database\Seeder;
use \App\Destination;

class DestinationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		// $destinations = [
		// 			['name' => 'Afrika', 'parent_name' => null],
		// 			['name' => 'Afrika Selatan', 'parent_name' => 'Afrika'],
		// 			['name' => 'Algeria', 'parent_name' => 'Afrika'],
		// 			['name' => 'Angola', 'parent_name' => 'Afrika'],
		// 			['name' => 'Benin', 'parent_name' => 'Afrika'],
		// 			['name' => 'Botswana', 'parent_name' => 'Afrika'],
		// 			['name' => 'Burkina Faso', 'parent_name' => 'Afrika'],
		// 			['name' => 'Burundi', 'parent_name' => 'Afrika'],
		// 			['name' => 'Chad', 'parent_name' => 'Afrika'],
		// 			['name' => 'Eritrea', 'parent_name' => 'Afrika'],
		// 			['name' => 'Ethiopia', 'parent_name' => 'Afrika'],
		// 			['name' => 'Gabon', 'parent_name' => 'Afrika'],
		// 			['name' => 'Gambia', 'parent_name' => 'Afrika'],
		// 			['name' => 'Ghana', 'parent_name' => 'Afrika'],
		// 			['name' => 'Guinea', 'parent_name' => 'Afrika'],
		// 			['name' => 'Guinea Khatulistiwa', 'parent_name' => 'Afrika'],
		// 			['name' => 'Guinea-Bissau', 'parent_name' => 'Afrika'],
		// 			['name' => 'Jibouti', 'parent_name' => 'Afrika'],
		// 			['name' => 'Kamerun', 'parent_name' => 'Afrika'],
		// 			['name' => 'Kenya', 'parent_name' => 'Afrika'],
		// 			['name' => 'Komoros', 'parent_name' => 'Afrika'],
		// 			['name' => 'Kongo', 'parent_name' => 'Afrika'],
		// 			['name' => 'Lesotho', 'parent_name' => 'Afrika'],
		// 			['name' => 'Liberia', 'parent_name' => 'Afrika'],
		// 			['name' => 'Libya', 'parent_name' => 'Afrika'],
		// 			['name' => 'Madagaskar', 'parent_name' => 'Afrika'],
		// 			['name' => 'Malawi', 'parent_name' => 'Afrika'],
		// 			['name' => 'Mali', 'parent_name' => 'Afrika'],
		// 			['name' => 'Maroko', 'parent_name' => 'Afrika'],
		// 			['name' => 'Mauritania', 'parent_name' => 'Afrika'],
		// 			['name' => 'Mauritius', 'parent_name' => 'Afrika'],
		// 			['name' => 'Mayotte', 'parent_name' => 'Afrika'],
		// 			['name' => 'Mesir', 'parent_name' => 'Afrika'],
		// 			['name' => 'Mozambique', 'parent_name' => 'Afrika'],
		// 			['name' => 'Namibia', 'parent_name' => 'Afrika'],
		// 			['name' => 'Niger', 'parent_name' => 'Afrika'],
		// 			['name' => 'Nigeria', 'parent_name' => 'Afrika'],
		// 			['name' => 'Pantai Gading', 'parent_name' => 'Afrika'],
		// 			['name' => 'Republik Afrika Tengah', 'parent_name' => 'Afrika'],
		// 			['name' => 'Republik Demokratik Kongo', 'parent_name' => 'Afrika'],
		// 			['name' => 'Rwanda', 'parent_name' => 'Afrika'],
		// 			['name' => 'Réunion', 'parent_name' => 'Afrika'],
		// 			['name' => 'Sahara Barat', 'parent_name' => 'Afrika'],
		// 			['name' => 'Saint Helena', 'parent_name' => 'Afrika'],
		// 			['name' => 'Sao Tome dan Principe', 'parent_name' => 'Afrika'],
		// 			['name' => 'Senegal', 'parent_name' => 'Afrika'],
		// 			['name' => 'Seychelles', 'parent_name' => 'Afrika'],
		// 			['name' => 'Sierra Leone', 'parent_name' => 'Afrika'],
		// 			['name' => 'Somalia', 'parent_name' => 'Afrika'],
		// 			['name' => 'Sudan', 'parent_name' => 'Afrika'],
		// 			['name' => 'Swaziland', 'parent_name' => 'Afrika'],
		// 			['name' => 'Tanjung Verde', 'parent_name' => 'Afrika'],
		// 			['name' => 'Tanzania', 'parent_name' => 'Afrika'],
		// 			['name' => 'Togo', 'parent_name' => 'Afrika'],
		// 			['name' => 'Tunisia', 'parent_name' => 'Afrika'],
		// 			['name' => 'Uganda', 'parent_name' => 'Afrika'],
		// 			['name' => 'Zambia', 'parent_name' => 'Afrika'],
		// 			['name' => 'Zimbabwe', 'parent_name' => 'Afrika'],
		// 			['name' => 'Amerika', 'parent_name' => null],
		// 			['name' => 'Amerika Serikat', 'parent_name' => 'Amerika'],
		// 			['name' => 'Anguilla', 'parent_name' => 'Amerika'],
		// 			['name' => 'Antigua dan Barbuda', 'parent_name' => 'Amerika'],
		// 			['name' => 'Antilles Belanda', 'parent_name' => 'Amerika'],
		// 			['name' => 'Argentina', 'parent_name' => 'Amerika'],
		// 			['name' => 'Aruba', 'parent_name' => 'Amerika'],
		// 			['name' => 'Bahamas', 'parent_name' => 'Amerika'],
		// 			['name' => 'Barbados', 'parent_name' => 'Amerika'],
		// 			['name' => 'Belize', 'parent_name' => 'Amerika'],
		// 			['name' => 'Bermuda', 'parent_name' => 'Amerika'],
		// 			['name' => 'Bolivia', 'parent_name' => 'Amerika'],
		// 			['name' => 'Brazil', 'parent_name' => 'Amerika'],
		// 			['name' => 'Chili', 'parent_name' => 'Amerika'],
		// 			['name' => 'Dominika', 'parent_name' => 'Amerika'],
		// 			['name' => 'Ekuador', 'parent_name' => 'Amerika'],
		// 			['name' => 'El Salvador', 'parent_name' => 'Amerika'],
		// 			['name' => 'Greenland', 'parent_name' => 'Amerika'],
		// 			['name' => 'Grenada', 'parent_name' => 'Amerika'],
		// 			['name' => 'Guadeloupe', 'parent_name' => 'Amerika'],
		// 			['name' => 'Guatemala', 'parent_name' => 'Amerika'],
		// 			['name' => 'Guyana', 'parent_name' => 'Amerika'],
		// 			['name' => 'Guyana Perancis', 'parent_name' => 'Amerika'],
		// 			['name' => 'Haiti', 'parent_name' => 'Amerika'],
		// 			['name' => 'Honduras', 'parent_name' => 'Amerika'],
		// 			['name' => 'Jamaika', 'parent_name' => 'Amerika'],
		// 			['name' => 'Kanada', 'parent_name' => 'Amerika'],
		// 			['name' => 'Kepulauan British Virgin', 'parent_name' => 'Amerika'],
		// 			['name' => 'Kepulauan Falkland', 'parent_name' => 'Amerika'],
		// 			['name' => 'Kepulauan Kayman', 'parent_name' => 'Amerika'],
		// 			['name' => 'Kepulauan Turks dan Caicos', 'parent_name' => 'Amerika'],
		// 			['name' => 'Kepulauan U.S. Virgin', 'parent_name' => 'Amerika'],
		// 			['name' => 'Kolombia', 'parent_name' => 'Amerika'],
		// 			['name' => 'Kosta Rika', 'parent_name' => 'Amerika'],
		// 			['name' => 'Kuba', 'parent_name' => 'Amerika'],
		// 			['name' => 'Martinique', 'parent_name' => 'Amerika'],
		// 			['name' => 'Mexico', 'parent_name' => 'Amerika'],
		// 			['name' => 'Montserrat', 'parent_name' => 'Amerika'],
		// 			['name' => 'Nicaragua', 'parent_name' => 'Amerika'],
		// 			['name' => 'Panama', 'parent_name' => 'Amerika'],
		// 			['name' => 'Paraguay', 'parent_name' => 'Amerika'],
		// 			['name' => 'Peru', 'parent_name' => 'Amerika'],
		// 			['name' => 'Puerto Riko', 'parent_name' => 'Amerika'],
		// 			['name' => 'Republik Dominika', 'parent_name' => 'Amerika'],
		// 			['name' => 'Saint Kitts dan Nevis', 'parent_name' => 'Amerika'],
		// 			['name' => 'Saint Pierre dan Miquelon', 'parent_name' => 'Amerika'],
		// 			['name' => 'Saint Vincent dan Grenadines', 'parent_name' => 'Amerika'],
		// 			['name' => 'Santa Lusia', 'parent_name' => 'Amerika'],
		// 			['name' => 'Suriname', 'parent_name' => 'Amerika'],
		// 			['name' => 'Trinidad dan Tobago', 'parent_name' => 'Amerika'],
		// 			['name' => 'Uruguay', 'parent_name' => 'Amerika'],
		// 			['name' => 'Venezuela', 'parent_name' => 'Amerika'],
		// 			['name' => 'Asia', 'parent_name' => null],
		// 			['name' => 'Afghanistan', 'parent_name' => 'Asia'],
		// 			['name' => 'Arab Saudi', 'parent_name' => 'Asia'],
		// 			['name' => 'Armenia', 'parent_name' => 'Asia'],
		// 			['name' => 'Azerbaijan', 'parent_name' => 'Asia'],
		// 			['name' => 'Bahrain', 'parent_name' => 'Asia'],
		// 			['name' => 'Bangladesh', 'parent_name' => 'Asia'],
		// 			['name' => 'Bhutan', 'parent_name' => 'Asia'],
		// 			['name' => 'Brunei', 'parent_name' => 'Asia'],
		// 			['name' => 'Cina', 'parent_name' => 'Asia'],
		// 			['name' => 'Filipina', 'parent_name' => 'Asia'],
		// 			['name' => 'Georgia', 'parent_name' => 'Asia'],
		// 			['name' => 'Hong Kong S.A.R., Cina', 'parent_name' => 'Asia'],
		// 			['name' => 'India', 'parent_name' => 'Asia'],
		// 			['name' => 'Indonesia', 'parent_name' => 'Asia'],
		// 			['name' => 'Iran', 'parent_name' => 'Asia'],
		// 			['name' => 'Iraq', 'parent_name' => 'Asia'],
		// 			['name' => 'Israel', 'parent_name' => 'Asia'],
		// 			['name' => 'Jepang', 'parent_name' => 'Asia'],
		// 			['name' => 'Kamboja', 'parent_name' => 'Asia'],
		// 			['name' => 'Kazakhstan', 'parent_name' => 'Asia'],
		// 			['name' => 'Korea Selatan', 'parent_name' => 'Asia'],
		// 			['name' => 'Korea Utara', 'parent_name' => 'Asia'],
		// 			['name' => 'Kuwait', 'parent_name' => 'Asia'],
		// 			['name' => 'Kyrgyzstan', 'parent_name' => 'Asia'],
		// 			['name' => 'Laos', 'parent_name' => 'Asia'],
		// 			['name' => 'Lebanon', 'parent_name' => 'Asia'],
		// 			['name' => 'Makao S.A.R. Cina', 'parent_name' => 'Asia'],
		// 			['name' => 'Malaysia', 'parent_name' => 'Asia'],
		// 			['name' => 'Maldives', 'parent_name' => 'Asia'],
		// 			['name' => 'Mongolia', 'parent_name' => 'Asia'],
		// 			['name' => 'Myanmar', 'parent_name' => 'Asia'],
		// 			['name' => 'Nepal', 'parent_name' => 'Asia'],
		// 			['name' => 'Oman', 'parent_name' => 'Asia'],
		// 			['name' => 'Otoritas Palestina', 'parent_name' => 'Asia'],
		// 			['name' => 'Pakistan', 'parent_name' => 'Asia'],
		// 			['name' => 'Qatar', 'parent_name' => 'Asia'],
		// 			['name' => 'Singapura', 'parent_name' => 'Asia'],
		// 			['name' => 'Siprus', 'parent_name' => 'Asia'],
		// 			['name' => 'Sri Lanka', 'parent_name' => 'Asia'],
		// 			['name' => 'Syria', 'parent_name' => 'Asia'],
		// 			['name' => 'Taiwan', 'parent_name' => 'Asia'],
		// 			['name' => 'Tajikistan', 'parent_name' => 'Asia'],
		// 			['name' => 'Thailand', 'parent_name' => 'Asia'],
		// 			['name' => 'Timor Timur', 'parent_name' => 'Asia'],
		// 			['name' => 'Turkey', 'parent_name' => 'Asia'],
		// 			['name' => 'Turkmenistan', 'parent_name' => 'Asia'],
		// 			['name' => 'Uni Emirat Arab', 'parent_name' => 'Asia'],
		// 			['name' => 'Uzbekistan', 'parent_name' => 'Asia'],
		// 			['name' => 'Vietnam', 'parent_name' => 'Asia'],
		// 			['name' => 'Yaman', 'parent_name' => 'Asia'],
		// 			['name' => 'Yordania', 'parent_name' => 'Asia'],
		// 			['name' => 'Eropa', 'parent_name' => null],
		// 			['name' => 'Albania', 'parent_name' => 'Eropa'],
		// 			['name' => 'Andora', 'parent_name' => 'Eropa'],
		// 			['name' => 'Austria', 'parent_name' => 'Eropa'],
		// 			['name' => 'Belarusia', 'parent_name' => 'Eropa'],
		// 			['name' => 'Belgia', 'parent_name' => 'Eropa'],
		// 			['name' => 'Bosnia dan Herzegovina', 'parent_name' => 'Eropa'],
		// 			['name' => 'Bulgaria', 'parent_name' => 'Eropa'],
		// 			['name' => 'Denmark', 'parent_name' => 'Eropa'],
		// 			['name' => 'Estonia', 'parent_name' => 'Eropa'],
		// 			['name' => 'Finlandia', 'parent_name' => 'Eropa'],
		// 			['name' => 'Gibraltar', 'parent_name' => 'Eropa'],
		// 			['name' => 'Guernsey', 'parent_name' => 'Eropa'],
		// 			['name' => 'Hungaria', 'parent_name' => 'Eropa'],
		// 			['name' => 'Inggris Raya', 'parent_name' => 'Eropa'],
		// 			['name' => 'Irlandia', 'parent_name' => 'Eropa'],
		// 			['name' => 'Islandia', 'parent_name' => 'Eropa'],
		// 			['name' => 'Isle of Man', 'parent_name' => 'Eropa'],
		// 			['name' => 'Itali', 'parent_name' => 'Eropa'],
		// 			['name' => 'Jerman', 'parent_name' => 'Eropa'],
		// 			['name' => 'Jersey', 'parent_name' => 'Eropa'],
		// 			['name' => 'Kepulauan Faroe', 'parent_name' => 'Eropa'],
		// 			['name' => 'Kroasia', 'parent_name' => 'Eropa'],
		// 			['name' => 'Latvia', 'parent_name' => 'Eropa'],
		// 			['name' => 'Liechtenstein', 'parent_name' => 'Eropa'],
		// 			['name' => 'Lithuania', 'parent_name' => 'Eropa'],
		// 			['name' => 'Luxembourg', 'parent_name' => 'Eropa'],
		// 			['name' => 'Macedonia', 'parent_name' => 'Eropa'],
		// 			['name' => 'Malta', 'parent_name' => 'Eropa'],
		// 			['name' => 'Moldova', 'parent_name' => 'Eropa'],
		// 			['name' => 'Monaco', 'parent_name' => 'Eropa'],
		// 			['name' => 'Montenegro', 'parent_name' => 'Eropa'],
		// 			['name' => 'Netherlands', 'parent_name' => 'Eropa'],
		// 			['name' => 'Norwegia', 'parent_name' => 'Eropa'],
		// 			['name' => 'Perancis', 'parent_name' => 'Eropa'],
		// 			['name' => 'Polandia', 'parent_name' => 'Eropa'],
		// 			['name' => 'Portugis', 'parent_name' => 'Eropa'],
		// 			['name' => 'Republik Ceko', 'parent_name' => 'Eropa'],
		// 			['name' => 'Romania', 'parent_name' => 'Eropa'],
		// 			['name' => 'Rusia', 'parent_name' => 'Eropa'],
		// 			['name' => 'San Marino', 'parent_name' => 'Eropa'],
		// 			['name' => 'Serbia', 'parent_name' => 'Eropa'],
		// 			['name' => 'Serbia dan Montenegro', 'parent_name' => 'Eropa'],
		// 			['name' => 'Siprus', 'parent_name' => 'Eropa'],
		// 			['name' => 'Slovakia', 'parent_name' => 'Eropa'],
		// 			['name' => 'Slovenia', 'parent_name' => 'Eropa'],
		// 			['name' => 'Spanyol', 'parent_name' => 'Eropa'],
		// 			['name' => 'Svalbard dan Jan Mayen', 'parent_name' => 'Eropa'],
		// 			['name' => 'Sweden', 'parent_name' => 'Eropa'],
		// 			['name' => 'Swiss', 'parent_name' => 'Eropa'],
		// 			['name' => 'Ukraina', 'parent_name' => 'Eropa'],
		// 			['name' => 'Vatikan', 'parent_name' => 'Eropa'],
		// 			['name' => 'Yunani', 'parent_name' => 'Eropa'],
		// 			['name' => '�Land Islands', 'parent_name' => 'Eropa'],
		// 			['name' => 'Oceania', 'parent_name' => null],
		// 			['name' => 'Antarktika', 'parent_name' => 'Oceania'],
		// 			['name' => 'Australia', 'parent_name' => 'Oceania'],
		// 			['name' => 'British Indian Ocean Territory', 'parent_name' => 'Oceania'],
		// 			['name' => 'Fiji', 'parent_name' => 'Oceania'],
		// 			['name' => 'Georgia Selatan dan Kepulauan Sandwich Selatan', 'parent_name' => 'Oceania'],
		// 			['name' => 'Guam', 'parent_name' => 'Oceania'],
		// 			['name' => 'Kaledonia Baru', 'parent_name' => 'Oceania'],
		// 			['name' => 'Kepualuan Mariana Utara', 'parent_name' => 'Oceania'],
		// 			['name' => 'Kepulauan Bouvet', 'parent_name' => 'Oceania'],
		// 			['name' => 'Kepulauan Cocos', 'parent_name' => 'Oceania'],
		// 			['name' => 'Kepulauan Cook', 'parent_name' => 'Oceania'],
		// 			['name' => 'Kepulauan Marshall', 'parent_name' => 'Oceania'],
		// 			['name' => 'Kepulauan Norfolk', 'parent_name' => 'Oceania'],
		// 			['name' => 'Kepulauan Solomon', 'parent_name' => 'Oceania'],
		// 			['name' => 'Kepulauan minor sekitar Amerika Serikat', 'parent_name' => 'Oceania'],
		// 			['name' => 'Kiribati', 'parent_name' => 'Oceania'],
		// 			['name' => 'Mikronesia', 'parent_name' => 'Oceania'],
		// 			['name' => 'Nauru', 'parent_name' => 'Oceania'],
		// 			['name' => 'Niue', 'parent_name' => 'Oceania'],
		// 			['name' => 'Palau', 'parent_name' => 'Oceania'],
		// 			['name' => 'Papua Nugini', 'parent_name' => 'Oceania'],
		// 			['name' => 'Pitcairn', 'parent_name' => 'Oceania'],
		// 			['name' => 'Polynesia Perancis', 'parent_name' => 'Oceania'],
		// 			['name' => 'Pulau Christmas', 'parent_name' => 'Oceania'],
		// 			['name' => 'Pulau Heard dan Kepulauan McDonald', 'parent_name' => 'Oceania'],
		// 			['name' => 'Samoa', 'parent_name' => 'Oceania'],
		// 			['name' => 'Samoa Amerika', 'parent_name' => 'Oceania'],
		// 			['name' => 'Selandia Baru', 'parent_name' => 'Oceania'],
		// 			['name' => 'Tokelau', 'parent_name' => 'Oceania'],
		// 			['name' => 'Tonga', 'parent_name' => 'Oceania'],
		// 			['name' => 'Tuvalu', 'parent_name' => 'Oceania'],
		// 			['name' => 'Vanuatu', 'parent_name' => 'Oceania'],
		// 			['name' => 'Wallis dan Futuna', 'parent_name' => 'Oceania'],
		// 			['name' => 'Wilayah Prancis Selatan', 'parent_name' => 'Oceania'],
		// 		];

		$destinations = [ 
			['name' => 'Eropa', 'parent_name' => null],
			['name' => 'Inggris', 'parent_name' => 'Eropa'],
			['name' => 'Belanda', 'parent_name' => 'Eropa'],
			['name' => 'Perancis', 'parent_name' => 'Eropa'],
			['name' => 'Italia', 'parent_name' => 'Eropa'],
			['name' => 'Spanyol', 'parent_name' => 'Eropa'],
			['name' => 'Portugal', 'parent_name' => 'Eropa'],
			['name' => 'Norwegia', 'parent_name' => 'Eropa'],
			['name' => 'Swiss', 'parent_name' => 'Eropa'],
			['name' => 'Jerman', 'parent_name' => 'Eropa'],

			['name' => 'Asia', 'parent_name' => null],
			['name' => 'Indonesia', 'parent_name' => 'Asia'],
			['name' => 'Bali', 'parent_name' => 'Indonesia'],
			['name' => 'Lombok', 'parent_name' => 'Indonesia'],
			['name' => 'Thailand', 'parent_name' => 'Asia'],
			['name' => 'Vietnam', 'parent_name' => 'Asia'],
			['name' => 'China', 'parent_name' => 'Asia'],
			['name' => 'Jepang', 'parent_name' => 'Asia'],
			['name' => 'Korea Selatan', 'parent_name' => 'Asia'],
			['name' => 'Taiwan', 'parent_name' => 'Asia'],

			['name' => 'Amerika', 'parent_name' => null],
			['name' => 'USA', 'parent_name' => 'Amerika'],
			['name' => 'Canada', 'parent_name' => 'Amerika'],

			['name' => 'Australia', 'parent_name' => null],
			['name' => 'Western Australia', 'parent_name' => 'Australia'],
			['name' => 'Victoria', 'parent_name' => 'Australia'],
			['name' => 'New South Wales', 'parent_name' => 'Australia'],
			['name' => 'Queensland', 'parent_name' => 'Australia'],
			['name' => 'Tasmania', 'parent_name' => 'Australia'],
			['name' => 'South Australia', 'parent_name' => 'Australia'],

			['name' => 'Afrika', 'parent_name' => null],
			['name' => 'South Afrika', 'parent_name' => 'Afrika'],
			['name' => 'Madagaskar', 'parent_name' => 'Afrika'],

		];

		foreach ($destinations as $x)
		{
			$destination = new Destination;
			$destination->fill(['name' => $x['name'], 'parent_id' => (is_null($x['parent_name']) ? null : Destination::NameLike($x['parent_name'])->first()->id)]);
			if (!$destination->save())
			{
				dd($destination->getErrors());
			}
		}
    }
}
