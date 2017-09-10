<?php

namespace common\models;

use yii;

/**
 * This is the model class for table "tag".
 *
 * @property integer $id
 * @property string $name
 * @property integer $frequency
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['frequency'], 'integer'],
            [['name'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'frequency' => 'Frequency',
        ];
    }

    public static function string2array($string_para)
    {
        return explode(',', $string_para);
    }

    public static function array2string($array_para)
    {
        return implode(',', $array_para);
    }

    public static function addTags($array_tags)
    {
        if (empty($array_tags))
        {
            return;
        }

        foreach ($array_tags as $key => $tag_item)
        {
            $atag = Tag::find()
                    ->where('name = :tag_name', ['tag_name' => $tag_item])
                    ->one();

            $tagCount = Tag::find()
                        ->where('name = :tag_name', ['tag_name' => $tag_item])
                        ->count();

            if (!$tagCount)
            {
                //插入新的标签
                $tag = new Tag();
                $tag->frequency = 1;
                $tag->name = $tag_item;
                $tag->save();
            }
            else
            {
                //更新标签
                $atag->frequency += 1;
                $atag->save();
            }
        }

    }

    public static function removeTag($tags)
    {
        if (empty($tags))
        {
            return;
        }

        foreach ($tags as $tag_name)
        {
            $rmTag = Tag::find()->where(['name' => $tag_name])->one();

            if (empty($rmTag))
            {
                return;
            }

            $rmTagCount = Tag::find()->where(['name' => $tag_name])->count();

            if ($rmTagCount <= 1)
            {
                $rmTag->delete();
            }
            else
            {
                $rmTag->frequency -= 1;
                $rmTag->save();
            }
        }
    }

    public static function updateFrequency($old_tags_str, $new_tags_str)
    {
        if (!empty($old_tags_str) || !empty($new_tags_str))
        {
            $old_tags_arr = self::string2array($old_tags_str);
            $new_tags_arr = self::string2array($new_tags_str);

            self::addTags(array_values(array_diff($new_tags_arr, $old_tags_arr)));
            self::removeTag(array_values(array_diff($old_tags_arr, $new_tags_arr)));
        }
    }
}
