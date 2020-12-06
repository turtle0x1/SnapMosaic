<?php

namespace dhope0000\SnapMosaic\Tools\Snaps;

use dhope0000\SnapMosaic\Tools\Hosts\GetHost;
use dhope0000\SnapMosaic\Tools\Utilities\StringTools;

class GetOverview
{
    private $getHost;

    public function __construct(GetHost $getHost)
    {
        $this->getHost = $getHost;
    }

    public function get()
    {
        $host = $this->getHost->get();

        $snaps = $host->snaps->all()["result"];

        foreach ($snaps as $index => $snap) {
            $snaps[$index]["icon-is-png"] = false;
            if (!isset($snap["icon"])) {
                continue;
            }

            if (StringTools::stringStartsWith($snap["icon"], "/v2/")) {
                $image = $host->icons->getIcon($snap["name"]);
                if (utf8_decode(substr($image, 0, 4)) == "?PNG") {
                    $snaps[$index]["icon"] = base64_encode($image);
                    $snaps[$index]["icon-is-png"] = true;
                } else {
                    $snaps[$index]["icon"] = $image;
                }
            }
        }

        usort($snaps, function ($a, $b) {
            return $a["title"] > $b["title"];
        });
        return $snaps;
    }
}
