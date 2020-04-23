<?php

namespace App\Service\DataCustom;

use App\Common\Service\Redis\Redis;
use App\Service\Content\ManualHelper;
use App\Service\GamePatch\Patch;

class PatchHelper extends ManualHelper
{
    const PRIORITY = 20;

    public function handle()
    {
        $contentNames = Redis::Cache()->get('content');
        $patchDb      = new Patch();
        foreach ($contentNames as $contentName) {
            $patchFilename = "./data/ffxiv-datamining-patches/patchdata/" . $contentName . ".json";
            if (!file_exists($patchFilename)) {
                echo "$patchFilename not exists, skipping...\n";
                continue;
            }
            $patchDataFile = file_get_contents($patchFilename);
            $patchData     = json_decode($patchDataFile, true);
            $ids = Redis::Cache()->get("ids_{$contentName}");
            if (!$ids) {
                echo "$contentName redis cache not exists, skipping...\n";
                continue;
            }
            foreach ($ids as $id) {
                $doc            = "xiv_{$contentName}_{$id}";
                $content        = Redis::Cache()->get("xiv_{$contentName}_{$id}");
                try {
                    $content->Patch = $patchData[$id];
                    $content->GamePatch = $patchDb->getPatchAtID($content->Patch);
                } catch (\Exception $exception) {
                    // If there's no patch to find, whatever, just go ahead.
                }
                Redis::Cache()->set($doc, $content, self::REDIS_DURATION);
            }
        }
    }
}
