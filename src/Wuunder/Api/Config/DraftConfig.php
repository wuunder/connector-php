<?php

namespace Wuunder\Api\Config;

class DraftConfig extends Config
{
    public function __construct()
    {
        parent::__construct();
        $this->defaultFields = array();
        $this->requiredFields = array(
            "drafts",
        );
    }

    public function addBookingConfig($unique_id, BookingConfig $bookingConfig, $safeInsert = False)
    {
        $currentDraftList = $this->getDrafts();
        if (empty($currentDraftList)) {
            $currentDraftList = array();
        } else if ($safeInsert) {
            foreach ($currentDraftList as $draft) {
                if ($draft['id'] == $unique_id) {
                    return false;
                }
            }
        }
        array_push($currentDraftList, array("id" => (string)$unique_id, "draft" => $bookingConfig));
        $this->setDrafts($currentDraftList);

        return true;
    }
}
