<?php

namespace Webkul\Core\Repositories;

use Webkul\Core\Eloquent\Repository;

/**
 * Core Config Reposotory
 *
 * @author    Jitendra Singh <jitendra@webkul.com>
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class CoreConfigRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Webkul\Core\Models\CoreConfig';
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        unset($data['_token']);

        if($data['locale'] || $data['channel']){
           $locale = $data['locale'];
           $channel = $data['channel'];
           unset($data['locale']);
           unset($data['channel']);
        }

        foreach($data as $key => $value) {
            $reomoveUnderScore = explode ("_", $key);
            $key= implode(".",$reomoveUnderScore);

            $field = $this->getField($key);

            $channel_based = false;
            $locale_based = false;

            if(isset($field['channel_based']) && $field['channel_based']) {
                $channel_based = true;
            }
            if(isset($field['locale_based']) && $field['locale_based']) {
                $locale_based = true;
            }

            $coreConfigValue = $this->model
                    ->where('code', $key)
                    ->where('locale_code', $locale_based ? $locale : null)
                    ->where('channel_code', $channel_based ? $channel : null)
                    ->get();

            if (!count($coreConfigValue) > 0) {
                $this->model->create([
                    'code' => $key,
                    'value' => $value,
                    'locale_code' => $locale_based ? $locale : null,
                    'channel_code' => $channel_based ? $channel : null
                ]);
            } else {
                $updataData['code'] = $key;
                $updataData['value'] = $value;
                $updataData['locale_code'] = $locale_based ? $locale : null;
                $updataData['channel_code'] = $channel_based ? $channel : null;

                foreach($coreConfigValue as $coreConfig) {
                    $coreConfig->update($updataData);
                }
            }
        }
    }

    /**
     * @param string $key
     * @return array
     */
    public function getField($key) {

        foreach (config('core') as $coreField => $coreData) {
            foreach ($coreData as $methodField => $methodData) {
                foreach ($methodData as $field) {

                    $fieldName = $coreField . '.' . $methodField . '.' . $field['name'];

                    if ($key == $fieldName) {
                        return $field;
                    }
                }
            }
        }
    }
}