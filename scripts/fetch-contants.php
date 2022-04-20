<?php

class InstitutionContacts
{
    public array $emails;
    public array $phone;
    public array $web;
}

function split(string $content): array {
    $content = trim($content);
    if (empty($content)) {
        return [];
    }
    $parts = preg_split('/[,;\s]+/', $content);
    $output = [];
    foreach ($parts as $part) {
        if (!empty($part)) {
            $output[] = $part;
        }
    }
    return $output;
}

function parseEmail(string $content): array {
    preg_match('/<td width="50%"><font class="titmodryb">Email:(.*?)<\/td>/s', $content, $matches);
    if (empty($matches)) {
        throw new \Exception("Could not parse email");
    }
    $match = strip_tags($matches[1]);
    return split($match);
}

function parsePhone(string $content): array {
    preg_match('/<td width="50%"><font class="titmodryb">Telefon:(.*?)<\/td>/s', $content, $matches);
    if (empty($matches)) {
        throw new \Exception("Could not parse phone");
    }
    $match = strip_tags($matches[1]);
    $phones = implode('', preg_split('/[\s]+/', trim($match)));
    if (empty($phones) || $phones === 'není') {
        return [];
    }
    return split($phones);
}

function parseWeb(string $content): array {
    preg_match('/<td width="50%"><font class="titmodryb">Webová stránka:(.*?)<\/td>/s', $content, $matches);
    if (empty($matches)) {
        throw new \Exception("Could not parse web");
    }
    $match = strip_tags($matches[1]);
    return split($match);
}

function parse(string $content): InstitutionContacts {
    // Remove &nbsp; entities
    $content = str_replace('&nbsp;', '', $content);

    $institutionContacts = new InstitutionContacts();
    $institutionContacts->emails = parseEmail($content);
    $institutionContacts->phone = parsePhone($content);
    $institutionContacts->web = parseWeb($content);
    return $institutionContacts;
}

function parseContent(string $content): InstitutionContacts {
    $content = iconv('cp1250', 'utf8', $content);

    if (strpos($content, 'No Records Returned') !== false) {
        return new InstitutionContacts();
    }

    return parse($content);
}

function getForRedIzo($redIzo): InstitutionContacts {
    $client = new \GuzzleHttp\Client();
    $res = $client->post('http://stistko.uiv.cz/registr/pam3n.asp', [
        'form_params' => [
            'red_izo' => $redIzo,
        ],
    ]);
    return parseContent($res->getBody()->getContents());
}
