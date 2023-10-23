<?php

namespace Drupal\message\Entity;

use Drupal\user\UserInterface;

interface MessageEntityInterface {

  /**
   * Gets the Message type.
   *
   * @return string
   *
   * The Message type.
   */
  public function getType(): string;

  /**
   * Gets the Message subject.
   *
   * @return string
   *
   * Subject of the Message.
   */
  public function getSubject(): string;

  /**
   * Sets the Message subject.
   *
   * @param string $subject
   *
   * The Message subject.
   *
   * @return \Drupal\message\Entity\MessageEntityInterface
   *
   * The called Message entity.
   */
  public function setSubject(string $subject): MessageEntityInterface;

  /**
   * Gets the Message creation timestamp.
   *
   * @return int
   *
   * Creation timestamp of the Message.
   */
  public function getCreatedTime(): int;

  /**
   * Sets the Message creation timestamp.
   *
   * @param int $timestamp
   *
   * The Message creation timestamp.
   *
   * @return \Drupal\message\Entity\MessageEntityInterface
   *
   * The called Message entity.
   */
  public function setCreatedTime(int $timestamp): MessageEntityInterface;

  /**
   * Returns the Message published status indicator.
   *
   * Unpublished Message are only visible to restricted users.
   *
   * @return bool
   *
   * TRUE if the Message is published.
   */
  public function isPublished(): bool;

  /**
   * Sets the published status of a Message.
   *
   * @param bool $published
   *
   * TRUE to set this Message to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\message\Entity\MessageEntityInterface
   *
   * The called Message entity.
   */
  public function setPublished(bool $published): MessageEntityInterface;

  /**
   * Gets the To user id.
   *
   * @return int
   *
   * The user id.
   */
  public function getUserToId(): int;

  /**
   * Sets the To user id.
   *
   * @param int $uid
   *
   * To user id.
   *
   * @return $this
   */
  public function setUserToId(int $uid): static;

  /**
   * Gets the To user object.
   *
   * @return UserInterface
   *
   * The user object.
   */
  public function getUserTo(): UserInterface;

  /**
   * Sets the To user object.
   *
   * @param string $account
   *
   * The user object.
   *
   * @return $this
   */
  public function setUserTo(string $account): static;

  /**
   * Gets the Content.
   *
   * @return string
   *
   * Message content.
   */
  public function getContent(): string;

  /**
   * Sets the message's content.
   *
   * @param string $content
   *
   * Message's content.
   *
   * @return $this
   */
  public function setContent(string $content): static;
  /**
   * Returns the Message read indicator.
   *
   * @return bool
   */
  public function isRead(): bool;
  /**
   * Sets the read status of a Message.
   *
   * @param bool $read
   *
  TRUE to set this Message to read.
   *
   * @return $this
   */
  public function setRead(bool $read): static;

}