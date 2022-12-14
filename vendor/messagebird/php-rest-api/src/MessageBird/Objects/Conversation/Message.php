<?php

namespace MessageBird\Objects\Conversation;

use JsonSerializable;
use MessageBird\Objects\Base;
use stdClass;

/**
 * Messages that have been sent by, or received from, a customer are
 * automatically threaded in a conversation. Any messages sent through the API
 * or received from your customer across any of your configured channels can be
 * retrieved via the messages resource. Messages are returned from the API in
 * the order they were created, with newest messages returned first.
 */
class Message extends Base implements JsonSerializable
{
    /**
     * A unique ID generated by the MessageBird platform that identifies this
     * message.
     *
     * @var string
     */
    public $id;

    /**
     * The unique ID that identifies the conversation that this message is a
     * part of.
     *
     * @var string
     */
    public $conversationId;

    /**
     * The unique ID that identifies the channel that the message is sent or
     * received on.
     *
     * @var string
     */
    public $channelId;

    /**
     * The direction of the message. Either 'sent' (mobile-terminated) for
     * outbound messages sent through the API or 'received' (mobile-originated)
     * for inbound messages from the contact.
     *
     * @var string|null
     */
    public $direction;

    /**
     * The status of the message. Possible values: "pending", "received",
     * "sent", "delivered", "read", "unsupported", "failed" and
     * "pending_media".
     *
     * @var string
     */
    public $status;

    /**
     * Type of this message's content. Possible values: "text", "image",
     * "audio", "video", "file", "location", "hsm", "interactive", "email".
     *
     * @var string
     */
    public $type;

    /**
     * Content of the message. Implementation dependent on this message's type.
     *
     * @var Content
     */
    public $content;

    /**
     * Identifier for the receiver. For example the phone number (MSISDN) for
     * SMS-based channels.
     *
     * @var string
     */
    public $to;

    /**
     * The date and time when this message was first created in RFC3339 format.
     *
     * @var string
     */
    public $createdDatetime;

    /**
     * The date and time when this message was most recently updated in
     * RFC3339 format.
     *
     * @var string
     */
    public $updatedDatetime;

    /**
     * @deprecated 2.2.0 No longer used by internal code, please switch to {@see self::loadFromStdclass()}
     * 
     * @param mixed $object
     */
    public function loadFromArray($object): Message
    {
        parent::loadFromArray($object);

        $content = new Content();
        $content->loadFromArray($this->content);

        $this->content = $content;

        return $this;
    }

    public function loadFromStdclass(stdClass $object): self
    {
        parent::loadFromStdclass($object);

        if (property_exists($object, 'content')) {
            $content = new Content();
            $content->loadFromStdclass($object->content);
            $this->content = $content;
        }

        return $this;
    }

    /**
     * Serialize only non empty fields.
     */
    public function jsonSerialize(): array
    {
        $json = [];

        foreach (get_object_vars($this) as $key => $value) {
            if (!empty($value)) {
                $json[$key] = $value;
            }
        }

        return $json;
    }
}
