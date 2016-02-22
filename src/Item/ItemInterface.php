<?php

namespace AndreasWeber\YealinkWorkflow\Item;

interface ItemInterface
{
    /**
     * Returns the items title.
     *
     * @return string
     */
    public function getTitle();

    /**
     * Returns the items subtitle.
     *
     * @return string
     */
    public function getSubtitle();

    /**
     * Returns the items icon relative path (to base directory).
     *
     * @return string
     */
    public function getIcon();

    /**
     * Returns the argument which is passed through the workflow to the connected output action.
     *
     * @return string
     */
    public function getArgument();

    /**
     * Returns the auto completion string.
     *
     * @return string
     */
    public function getAutoComplete();

    /**
     * Returns the unique identifier for the item which allows help Alfred to learn about this item for subsequent
     * sorting and ordering of the user's actioned results.
     *
     * @return string
     */
    public function getUid();

    /**
     * Returns whether the item is valid or not.
     *
     * If the item is set as invalid", the auto-complete text is populated into Alfred's search field when the user
     * actions the result.
     *
     * @return bool
     */
    public function isValid();
}
