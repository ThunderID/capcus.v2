<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| as the size rules. Feel free to tweak each of these messages here.
	|
	*/

	"accepted"              => "Isian :attribute harus disetujui.",
	"active_url"            => "Isian :attribute bukan valid URL.",
	"after"                 => "Isian :attribute harus berupa tanggal setelah :date.",
	"alpha"                 => "Isian :attribute hanya boleh berupa kata.",
	"alpha_dash"            => "Isian :attribute hanya boleh berupa kata, nomor, and penghubung.",
	"alpha_num"             => "Isian :attribute hanya boleh berupa kata and nomor.",
	"array"                 => "Isian :attribute harus berupa array.",
	"before"                => "Isian :attribute harus berupa tanggal sebelum :date.",
	"between"               => array(
		"numeric"           => "Isian :attribute harus diantara :min - :max.",
		"file"              => "Isian :attribute harus diantara :min - :max KB.",
		"string"            => "Isian :attribute harus diantara :min - :max karakter.",
		"array"             => "Isian :attribute harus diantara :min and :max items.",
	),
	"boolean"               => "Isian :attribute harus berupa true atau false",
	"confirmed"             => "Isian :attribute konfirmasi tidak cocok.",
	"date"                  => "Isian :attribute bukan tanggal valid.",
	"date_format"           => "Isian :attribute tidak cocok dengan format :format.",
	"different"             => "Isian :attribute dan :other harus berbeda.",
	"digits"                => "Isian :attribute harus berupa :digits digit.",
	"digits_between"        => "Isian :attribute harus di antara :min and :max digit.",
	"email"                 => "Isian :attribute bukan berupa valid email.",
	"filled"                => "Isian :attribute harus diisi.",
	"exists"                => "Isian terpilih :attribute tidak valid.",
	"image"                 => "Isian :attribute harus berupa gambar.",
	"in"                    => "Isian selected :attribute tidak valid.",
	"integer"               => "Isian :attribute harus berupa integer.",
	"ip"                    => "Isian :attribute harus berupa IP address.",
	"max"                   => array(
		"numeric"           => "Isian :attribute tidak boleh lebih dari :max.",
		"file"              => "Isian :attribute tidak boleh lebih dari :max KB.",
		"string"            => "Isian :attribute tidak boleh lebih dari :max karakter.",
		"array"             => "Isian :attribute tidak boleh lebih dari :max items.",
	),
	"mimes"                 => "Isian :attribute harus berupa file: :values.",
	"min"                   => array(
		"numeric"           => "Isian :attribute harus lebih dari :min.",
		"file"              => "Isian :attribute harus lebih dari :min KB.",
		"string"            => "Isian :attribute harus lebih dari :min karakter.",
		"array"             => "Isian :attribute harus paling tidak :min items.",
	),
	"not_in"                => "Isian selected :attribute tidak valid.",
	"numeric"               => "Isian :attribute harus berupa angka.",
	"regex"                 => "Isian :attribute format tidak valid.",
	"required"              => "Isian :attribute harus diisi.",
	"required_if"           => "Isian :attribute harus diisi ketika :other adalah :value.",
	"required_with"         => "Isian :attribute harus diisi ketika :values ada.",
	"required_with_all"     => "Isian :attribute harus diisi ketika :values tidak ada.",
	"required_without"      => "Isian :attribute harus diisi ketika :values tidak ada.",
	"required_without_all"  => "Isian :attribute harus diisi ketika :values tidak ada.",
	"same"                  => "Isian :attribute and :other harus sama.",
	"size"                  => array(
		"numeric"           => "Isian :attribute harus :size.",
		"file"              => "Isian :attribute harus :size KB.",
		"string"            => "Isian :attribute harus :size karakter.",
		"array"             => "Isian :attribute harus berisi :size items.",
	),
	"unique"                => "Isian :attribute sudah terdaftar sebelumnya.",
	"url"                   => "Isian :attribute format tidak valid.",
	"timezone"              => "Isian :attribute timezone tidak valid.",

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/

	'custom' => [
		'attribute-name' => [
			'rule-name' => 'custom-message',
		],
	],

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => [],

];