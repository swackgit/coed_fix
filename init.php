<?php class coed_fix extends Plugin {
        private $host;
        function about() {
                return array(1.0,
                        "changes links to direct images",
                        "swack");
        }
        function init($host) {
                $this->host = $host;
                $host->add_hook($host::HOOK_ARTICLE_FILTER, $this);
        }
        function hook_article_filter($article) {
                if(strpos($article["link"], "toplesspulp.com") !== FALSE)
                {
                        $subject = $article["content"];
                        $pattern = '~(<a href.*?opener">)(<img.*?(src=".*?)(?:\?w=).*?\/><\/a>)~';
                        $replace = '<img \3"\/>';
                        $article["content"] = preg_replace($pattern,$replace,$subject);
                }
                return $article;
        }
        function api_version() {
                return 2;
        }
}
