<?php 

namespace App\Http\Controllers\Admin\Traits;
use \Illuminate\Support\MessageBag;

trait RequireImagesTrait {

	function save_required_images($data, $input)
	{
		if ($this->required_images)
		{
			// Cover Image
			foreach ($this->required_images as $field_name => $label) 
			{
				$images[$field_name] 	= $data->images->where('name', $field_name)->first();
				if ($images[$field_name])
				{
					$images[$field_name]->fill(['path' => $input[$field_name], 'description' => $input[$field_name.'_description'], 'name' => $field_name]);
				}
				else
				{
					$images[$field_name] = new \App\Image(['path' => $input[$field_name], 'description' => $input[$field_name.'_description'], 'name' => $field_name]);
				}

				if (!$images[$field_name]->save())
				{
					$data->setError(new MessageBag([$field_name => implode(', ', array_dot($images[$field_name]->getErrors()->toArray()))]));
					return false;
				}
			}

			$data->images()->saveMany($images);
		}

		return true;
	}

}
