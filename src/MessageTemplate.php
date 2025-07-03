<?php

namespace ZakharovAndrew\sender\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Json;
use ZakharovAndrew\sender\Module;

/**
 * Message template for email/telegram notifications.
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property int $type (1=email, 2=telegram)
 * @property int|null $group_id
 * @property string|null $variables (JSON)
 * @property int $created_at
 * @property int $updated_at
 */
class MessageTemplate extends ActiveRecord
{
    const TYPE_EMAIL = 1;
    const TYPE_TELEGRAM = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%sender_message_template}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'content', 'type'], 'required'],
            [['content'], 'string'],
            [['group_id', 'type'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['type'], 'in', 'range' => [self::TYPE_EMAIL, self::TYPE_TELEGRAM]],
            [['variables'], 'safe'], // JSON validation
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('sender', 'ID'),
            'title' => Module::t('sender', 'Template Name'),
            'content' => Module::t('sender', 'Content'),
            'type' => Module::t('sender', 'Type'),
            'group_id' => Module::t('sender', 'Group'),
            'variables' => Module::t('sender', 'Variables'),
            'created_at' => Module::t('sender', 'Created At'),
            'updated_at' => Module::t('sender', 'Updated At'),
        ];
    }

    /**
     * Returns available template types as [id => label].
     *
     * @return array
     */
    public static function getTypes()
    {
        return [
            self::TYPE_EMAIL => Module::t('sender', 'Email'),
            self::TYPE_TELEGRAM => Module::t('sender', 'Telegram'),
        ];
    }

    /**
     * Gets the human-readable type name.
     *
     * @return string|null
     */
    public function getTypeLabel()
    {
        return self::getTypes()[$this->type] ?? null;
    }

    /**
     * Decodes JSON variables into an array.
     *
     * @return array
     */
    public function getVariablesArray()
    {
        return empty($this->variables) ? [] : Json::decode($this->variables);
    }

    /**
     * Encodes an array of variables into JSON.
     *
     * @param array $data
     */
    public function setVariablesArray(array $data)
    {
        $this->variables = Json::encode($data);
    }
}
