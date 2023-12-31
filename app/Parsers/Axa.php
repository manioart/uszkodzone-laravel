<?php

namespace App\Parsers;

use Carbon\Carbon;
use App\Models\Auction;
use App\Models\File;
use App\Services\FileService;
use Exception;

class Axa
{

    const USER_AGENT = 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.2309.372 Safari/537.36';
    const COOKIE_FILE = 'cookie.txt';

    public function save() {
        
        $curl = curl_init(decrypt(config('parser.parser')));
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($curl, CURLOPT_COOKIEJAR, self::COOKIE_FILE);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_exec($curl);
    
        if (curl_errno($curl)) {
            throw new Exception(curl_error($curl));
        }
    
        $html = curl_exec($curl);
    
        preg_match_all('|rel=.bookmark.[\s]*title=.[\#\&\;\s\)0-9a-zA-ZWÆÐƎƏƐƔĲŊŒẞÞǷȜæðǝəɛɣĳŋœĸſßþƿȝĄƁÇĐƊĘĦĮƘŁØƠŞȘŢȚŦŲƯY̨Ƴąɓçđɗęħįƙłøơşșţțŧųưy̨ƴÁÀÂÄǍĂĀÃÅǺĄÆǼǢƁĆĊĈČÇĎḌĐƊÐÉÈĖÊËĚĔĒĘẸƎƏƐĠĜǦĞĢƔáàâäǎăāãåǻąæǽǣɓćċĉčçďḍđɗðéèėêëěĕēęẹǝəɛġĝǧğģɣĤḤĦIÍÌİÎÏǏĬĪĨĮỊĲĴĶƘĹĻŁĽĿʼNŃN̈ŇÑŅŊÓÒÔÖǑŎŌÕŐỌØǾƠŒĥḥħıíìiîïǐĭīĩįịĳĵķƙĸĺļłľŀŉńn̈ňñņŋóòôöǒŏōõőọøǿơœŔŘŖŚŜŠŞȘṢẞŤŢṬŦÞÚÙÛÜǓŬŪŨŰŮŲỤƯẂẀŴẄǷÝỲŶŸȲỸƳŹŻŽẒŕřŗſśŝšşșṣßťţṭŧþúùûüǔŭūũűůųụưẃẁŵẅƿýỳŷÿȳỹƴźżžẓ+\/\(\,\.\-\']*.|', $html, $titles);
    
        for ($i = 0; $i < count($titles[0]); $i++) {
            $temp_t = str_replace('rel="bookmark"', "", $titles[0][$i]);
            $temp_t = str_replace('"', "", $temp_t);
            $temp_t = str_replace('title=', "", $temp_t);
            $temp_t = ltrim($temp_t);
            $temp_t = rtrim($temp_t);
            $titles[0][$i] = $temp_t;
        }
    
        preg_match_all('#DATA.ZAKONCZENIA.AUKCJI:[\s0-9-:]*#', $html, $endDates);
    
        for ($i = 0; $i < count($endDates[0]); $i++) {
            $temp_e = str_replace("DATA ZAKONCZENIA AUKCJI: ", "", $endDates[0][$i]);
            $temp_e = ltrim($temp_e);
            $temp_e = rtrim($temp_e);
            $endDates[0][$i] = $temp_e;
        }

        $checkSum = [];
    
        for ($i = 0; $i < count($titles[0]); $i++) {
            $temp_e = str_replace(":", "", $endDates[0][$i]);
            $temp_e = str_replace("-", "", $temp_e);
            $temp_e = str_replace(" ", "", $temp_e);
            $checkSum[0][$i] = $temp_e;
            $titles[0][$i] .= ' ' . $checkSum[0][$i];
        }
    
        preg_match_all('#<a.href="/samochody/[0-9]*/#', $html, $links);
    
        for ($i = 0; $i < count($links[0]); $i++) {
            $temp_l = str_replace('<a href="', "", $links[0][$i]);
            $temp_l = decrypt(config('parser.parser')).$temp_l;
            $links[0][$i] = $temp_l;
    
                }
    
        for ($i = 0; $i < count($links[0]); $i++) {
            curl_setopt($curl, CURLOPT_URL, $links[0][$i]);
            curl_setopt($curl, CURLOPT_COOKIEJAR, self::COOKIE_FILE);
            curl_setopt($curl, CURLOPT_USERAGENT, self::USER_AGENT);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
    
            $subpage = curl_exec($curl);
    
            preg_match('|<table[\#\&\;\)\s\Wa-zA-Z0-9WÆÐƎƏƐƔĲŊŒẞÞǷȜæðǝəɛɣĳŋœĸſßþƿȝĄƁÇĐƊĘĦĮƘŁØƠŞȘŢȚŦŲƯY̨Ƴąɓçđɗęħįƙłøơşșţțŧųưy̨ƴÁÀÂÄǍĂĀÃÅǺĄÆǼǢƁĆĊĈČÇĎḌĐƊÐÉÈĖÊËĚĔĒĘẸƎƏƐĠĜǦĞĢƔáàâäǎăāãåǻąæǽǣɓćċĉčçďḍđɗðéèėêëěĕēęẹǝəɛġĝǧğģɣĤḤĦIÍÌİÎÏǏĬĪĨĮỊĲĴĶƘĹĻŁĽĿʼNŃN̈ŇÑŅŊÓÒÔÖǑŎŌÕŐỌØǾƠŒĥḥħıíìiîïǐĭīĩįịĳĵķƙĸĺļłľŀŉńn̈ňñņŋóòôöǒŏōõőọøǿơœŔŘŖŚŜŠŞȘṢẞŤŢṬŦÞÚÙÛÜǓŬŪŨŰŮŲỤƯẂẀŴẄǷÝỲŶŸȲỸƳŹŻŽẒŕřŗſśŝšşșṣßťţṭŧþúùûüǔŭūũűůųụưẃẁŵẅƿýỳŷÿȳỹƴźżžẓ+\/\(\,\.\-\']*<.table>|', $subpage, $description);
    
            $temp_d = preg_replace('#<a data-toggle="collapse".data-parent="[a-zA-Z\W]*".href="[a-zA-Z\W]*".class="collapsing">#', "",$description);
            $temp_d = str_replace('</a>', "",$temp_d);
            $description = $temp_d;
            preg_match('|1. Inv.[0-9\/\s\t\S]*Getriebe<[\/]td>|', $subpage, $year);
            $temp_d = mb_substr($year[0],-53,4);
            $year = $temp_d;
            $years[0][$i] = $year;
            preg_match('|<p>[\s\W0-9a-zA-Z]*<br>[\s]*<.p>|', $subpage, $image);
            $images[0][$i] = $image;
            $descriptions[0][$i] = implode(" ",$description);
        }
                
        if (count($titles[0]) == count($endDates[0]) && count($titles[0])  == count($descriptions[0]) && count($titles[0]) == count($images[0]) && count($titles[0]) == count($years[0])) {
    
            for ($i = 0; $i < count($titles[0]); $i++) {

                preg_match_all('/src="([^"]+)"/i', $images[0][$i][0], $srcArray);
                
                $auction = Auction::firstOrCreate([
                                'title' => $titles[0][$i]
                            ],
                            [
                                'insurance' => 'Axa',
                                'end_date' => Carbon::parse($endDates[0][$i]),
                                'content' => $descriptions[0][$i],
                                'year_of_prod' => $years[0][$i]
                            ]
                        );

                        foreach ($srcArray[0] as $src) {
                            $src = str_replace('src="/images/','',$src);
                            $src = decrypt(config('parser.parser')).'/images/' . $src;
                            $url = $src;
                            $src = str_replace('"', '', $src);
                            $url = str_replace(decrypt(config('parser.parser')).'/images/', '', $url);
                            $url = preg_replace('#/#', '-', $url);
                            $url = str_replace('"', '', $url);

        
                            if (str_contains($src, 'jpg')) {
                                $fileService = (new FileService());
                                $fileService->storeFile($src, $url, $auction);
                            }
                        }

                dump($auction->title);            
            }
        }
    }
}