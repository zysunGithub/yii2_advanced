<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property integer $id
 * @property string $content
 * @property integer $status
 * @property integer $create_time
 * @property integer $userid
 * @property string $email
 * @property string $url
 * @property integer $post_id
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'content', 'status', 'userid', 'email', 'post_id'], 'required'],
            [['id', 'status', 'create_time', 'userid', 'post_id'], 'integer'],
            [['content'], 'string'],
            [['email', 'url'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '评论ID',
            'content' => '评论简述',
            'status' => '评论状态',
            'create_time' => '创建时间',
        ];
    }

    public function getUserInfo()
    {
        return $this->hasOne(User::className(), ['id' => 'userid']);
    }

    public function getStatus0()
    {
        return $this->hasOne(Commentstatus::className(), ['id' => 'status']);
    }

    public function getSimpleComment()
    {
        //去掉评论中的标签
        $stripTagStr = strip_tags($this->content);
        $strLength = mb_strlen($stripTagStr);

        return mb_substr($stripTagStr, 0, 20, 'utf-8').($strLength > 20 ? '……' : '');
    }

    public function approve()
    {
        $this->status = 2;

        //save时会先进行数据校验，校验失败则不会保存数据
        return $this->save();
    }
}
