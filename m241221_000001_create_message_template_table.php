<?php

use yii\db\Migration;

/**
 * Creates the table for message templates.
 */
class m241221_000002_create_message_template_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%sender_message_template}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull()->comment('Template name'),
            'content' => $this->text()->notNull()->comment('Template content (HTML/text)'),
            'type' => $this->tinyInteger(1)->notNull()->comment('Template type: 1=email, 2=telegram'),
            'group_id' => $this->integer()->null()->comment('ID of the template group'),
            'variables' => $this->text()->null()->comment('Available template variables (JSON)'),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ]);

        // Index for group_id (improves JOIN performance)
        $this->createIndex(
            'idx-sender_message_template-group_id',
            '{{%sender_message_template}}',
            'group_id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%sender_message_template}}');
    }
}
