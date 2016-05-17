<?php
/**
 * get instagram's photos, with widget websta.me
 */
class InstaWebstaMe
{
  private $imagesURLs = array();

  /**
   * @param $webstame: URL from <iframe> of plugin websta.me
   */
  function __construct($webstame)
  {
    $cURL = curl_init();

    curl_setopt_array($cURL, array(
      CURLOPT_RETURNTRANSFER => 1,
      CURLOPT_URL => $webstame
    ));

    $webstame = curl_exec($cURL);
    curl_close($cURL);

    // RegEx to get 'background-image' CSS value from elements <a>
    $regexIMG = "#url\((.*)\);#";

    preg_match_all($regexIMG, $webstame, $imgsInsta, PREG_PATTERN_ORDER);

    $this->imagesURLs = $imgsInsta[1];
  }

  /**
   * get imagesURLs
   */
  public function getURLImages()
  {
    return $this->imagesURLs;
  }
}
