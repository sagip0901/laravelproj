<?php

namespace App\Lib;

class TemplatePrompt {

    public static function templateCode($code, $request, $maxToken) {
        $prompt         = '';
        $templateMethod = new self();
        switch ($code) {
        case 'WAWCHW':
            $prompt = $templateMethod->getClickBaitContent($request, $maxToken);
            break;
        case '4PMFFH':
            $prompt = $templateMethod->generateAdHeadlineContent($request, $maxToken);
            break;
        case 'T7C4BC':
            $prompt = $templateMethod->generateParagraphContent($request, $maxToken);
            break;
        case 'ZVQ4RA':
            $prompt = $templateMethod->generateProductDescriptionContent($request, $maxToken);
            break;
        case '1HW6VS':
            $prompt = $templateMethod->generateProductName($request, $maxToken);
            break;
        case 'YJUT39':
            $prompt = $templateMethod->generateProductFeatures($request, $maxToken);
            break;
        case 'JOF27W':
            $prompt = $templateMethod->generateSEOContent($request, $maxToken);
            break;
        case 'CNQUZR':
            $prompt = $templateMethod->generateArticle($request, $maxToken);
            break;
        case '1YAC5S':
            $prompt = $templateMethod->generateArticlePublication($request, $maxToken);
            break;
        case '1J3GDX':
            $prompt = $templateMethod->generateArticleProductDescription($request, $maxToken);
            break;
        case 'R9TE88':
            $prompt = $templateMethod->generateEmailDescription($request, $maxToken);
            break;
        case 'KYO8A1':
            $prompt = $templateMethod->generateEmailSubject($request, $maxToken);
            break;
        case 'W79QHT':
            $prompt = $templateMethod->generateGoogleAdDescription($request, $maxToken);
            break;
        case 'JSRMA2':
            $prompt = $templateMethod->generateFacebookAdHeadline($request, $maxToken);
            break;
        case 'ZJNTFS':
            $prompt = $templateMethod->generateLinkedinAdHeadline($request, $maxToken);
            break;
        case 'YF6CUM':
            $prompt = $templateMethod->generateBlogTitle($request, $maxToken);
            break;
        case '2S7YTD':
            $prompt = $templateMethod->generateBlogFeatures($request, $maxToken);
            break;
        case 'C2HG6M':
            $prompt = $templateMethod->generateBlogConclusion($request, $maxToken);
            break;
        case 'PWFJFR':
            $prompt = $templateMethod->generateBlogDescription($request, $maxToken);
            break;
        case 'QRKEDF':
            $prompt = $templateMethod->generateAmazonProductDescription($request, $maxToken);
            break;
        case 'KP5V54':
            $prompt = $templateMethod->generateMarketingAdHeadline($request, $maxToken);
            break;
        case 'X71FTM':
            $prompt = $templateMethod->generateSEOKeywords($request, $maxToken);
            break;
        case 'V329S7':
            $prompt = $templateMethod->generateRealStateSaleDescription($request, $maxToken);
            break;
        case 'TAKY5T':
            $prompt = $templateMethod->generateProductPressRelease($request, $maxToken);
            break;
        case 'YHY8BP':
            $prompt = $templateMethod->generateFacebookAd($request, $maxToken);
            break;
        case 'KOSCE3':
            $prompt = $templateMethod->generateYoutubeVideoDescription($request, $maxToken);
            break;
        case 'TF9URK':
            $prompt = $templateMethod->generatePersonalSocialaPost($request, $maxToken);
            break;
        case 'W9OEOT':
            $prompt = $templateMethod->generateContentWriting($request, $maxToken);
            break;
        case 'F1OSZU':
            $prompt = $templateMethod->generateInstagramCaptions($request, $maxToken);
            break;
        case '5S9F6V':
            $prompt = $templateMethod->generateFacebookCaptions($request, $maxToken);
            break;
        case '2W5SMC':
            $prompt = $templateMethod->generateYoutubeHashTag($request, $maxToken);
            break;
        case '2H7PR5':
            $prompt = $templateMethod->generateYoutubeVideoTitle($request, $maxToken);
            break;
        case 'QSVMNZ':
            $prompt = $templateMethod->generateTiktokVideoDescription($request, $maxToken);
            break;
        case 'BM6HHX':
            $prompt = $templateMethod->generateLinkedinPostDescription($request, $maxToken);
            break;
        case 'UJJ6ZG':
            $prompt = $templateMethod->generateMetaDescription($request, $maxToken);
            break;
        case 'NVW6UR':
            $prompt = $templateMethod->generateFAQ($request, $maxToken);
            break;
        case 'PSFS6P':
            $prompt = $templateMethod->generateTestimonials($request, $maxToken);
            break;
        case 'SS38KG':
            $prompt = $templateMethod->generateTalkingPoint($request, $maxToken);
            break;
        case 'JV2F7U':
            $prompt = $templateMethod->generateProsandCons($request, $maxToken);
            break;
        case 'SEOK51':
            $prompt = $templateMethod->generateTwitterTweet($request, $maxToken);
            break;
        case 'YRDWVG':
            $prompt = $templateMethod->generateGoogleAdHeadline($request, $maxToken);
            break;
        default:
            break;
        }

        return $prompt;
    }

    private function generateGoogleAdHeadline($request, $maxToken) {
        $prompt = "Provide a response in " . $request->language . " language.\n\n Create google ads with my give information" . "\n\n This is product name : " . $request->product_name . "\n\n This is product description : " . $request->product_description . ". The minimum length of the google ads must be " . $maxToken . " words.\n\n" . "\n\n and Create seperate distinct ' . $request->result_quantity . ' results";
        return $prompt;
    }

    private function generateTwitterTweet($request, $maxToken) {
        $prompt = "Provide a response in " . $request->language . " language.\n\n Write a trending tweet for a Twitter post about: " . $request->description . ". The minimum length of the tweet must be " . $maxToken . " words.\n\n" . "\n\n and Create seperate distinct ' . $request->result_quantity . ' results";
        return $prompt;
    }

    private function generateProsandCons($request, $maxToken) {
        $prompt = "Provide a response in " . $request->language . " language.\n\n Write pros and cons of these products: " . $request->title . ". Use following product name :" . $request->product_name . "\n\n and  product description: " . $request->description . ". The minimum length of the pros and cons must be " . $maxToken . " words.\n\n" . "\n\n and Create seperate distinct ' . $request->result_quantity . ' results";

        return $prompt;
    }

    private function generateTalkingPoint($request, $maxToken) {
        $prompt = "Provide a response in " . $request->language . " language.\n\n Write short, simple and informative talking points for " . $request->title . ". And also similar talking points for description: " . $request->description . ". The minimum length of the talking points must be " . $maxToken . " words.\n\n" . "\n\n and Create seperate distinct ' . $request->result_quantity . ' results";

        return $prompt;
    }

    private function generateTestimonials($request, $maxToken) {
        $prompt = "Provide a response in " . $request->language . " language.\n\n Create product testimonials or reviews  with my give information" . "\n\n This is product name : " . $request->product_name . "\n\n This is product description : " . $request->product_description . ".\n\n The minimum length of the product testimonials or reviews must be " . $maxToken . " words.\n\n" . "\n\n and Create seperate distinct ' . $request->result_quantity . ' results";
        return $prompt;
    }

    private function generateFAQ($request, $maxToken) {
        $prompt = "Provide a response in " . $request->language . " language.\n\n Create FAQ question and answer with order list  with my give information" . "\n\n This is product name : " . $request->product_name . "\n\n This is product description : " . $request->product_description . ".\n\n The minimum length of the FAQ question and answer with order list must be " . $maxToken . " words.\n\n" . "\n\n and Create seperate distinct ' . $request->result_quantity . ' results";
        return $prompt;
    }

    private function generateMetaDescription($request, $maxToken) {
        $prompt = "Provide a response in " . $request->language . " language.\n\n Create meta description of the product with my give information" . "\n\n This is website name : " . $request->website_name . "\n\n This is website description : " . $request->website_description . ".\n\n The minimum length of the meta description must be " . $maxToken . " words.\n\n" . "\n\n and Create seperate distinct ' . $request->result_quantity . ' results";
        return $prompt;
    }

    private function generateLinkedinPostDescription($request, $maxToken) {
        $prompt = "Provide a response in " . $request->language . " language.\n\n Create linkedin post description with my give information" . "\n\n This is post title : " . $request->post_title . ".\n\n The minimum length of the linkedin post description must be " . $maxToken . " words.\n\n" . "\n\n and Create seperate distinct ' . $request->result_quantity . ' results";
        return $prompt;
    }

    private function generateTiktokVideoDescription($request, $maxToken) {
        $prompt = "Provide a response in " . $request->language . " language.\n\n Create tiktok video description with my give information" . "\n\n This is video title : " . $request->tiktok_video_title . ".\n\n The minimum length of the tiktok video description must be " . $maxToken . " words.\n\n" . "\n\n and Create seperate distinct ' . $request->result_quantity . ' results";
        return $prompt;
    }

    private function generateYoutubeVideoTitle($request, $maxToken) {
        $prompt = "Provide a response in " . $request->language . " language.\n\n Create youtube video title with my give information" . "\n\n This is video description : " . $request->video_description . ".\n\n The minimum length of the youtube video title must be " . $maxToken . " words.\n\n" . "\n\n and Create seperate distinct ' . $request->result_quantity . ' results";
        return $prompt;
    }

    private function generateYoutubeHashTag($request, $maxToken) {
        $prompt = "Provide a response in " . $request->language . " language.\n\n Create youtube video hash tag list with my give information" . "\n\n This is video description : " . $request->video_description . ".\n\n The minimum length of the youtube video hash tag list must be " . $maxToken . " words.\n\n" . "\n\n and Create seperate distinct ' . $request->result_quantity . ' results";
        return $prompt;
    }

    private function generateFacebookCaptions($request, $maxToken) {
        $prompt = "Provide a response in " . $request->language . " language.\n\n Create facebook captions with my give information" . "\n\n This is product name : " . $request->product_name . "\n\n This is product description : " . $request->product_description . ".\n\n The minimum length of the facebook captions must be " . $maxToken . " words.\n\n" . "\n\n and Create seperate distinct ' . $request->result_quantity . ' results";
        return $prompt;
    }

    private function generateInstagramCaptions($request, $maxToken) {
        $prompt = "Provide a response in " . $request->language . " language.\n\n Create instagram captions with my give information" . "\n\n This is product name : " . $request->product_name . "\n\n This is product description : " . $request->product_description . ".\n\n The minimum length of the instagram captions must be " . $maxToken . " words.\n\n" . "\n\n and Create seperate distinct ' . $request->result_quantity . ' results";
        return $prompt;
    }

    private function generateContentWriting($request, $maxToken) {
        $prompt = "Provide a response in " . $request->language . " language.\n\n Create content writing with my give information" . "\n\n This is rewite description : " . $request->rewrite_description . ".\n\n The minimum length of the content writing must be " . $maxToken . " words.\n\n" . "\n\n and Create seperate distinct ' . $request->result_quantity . ' results";
        return $prompt;
    }

    private function generatePersonalSocialaPost($request, $maxToken) {
        $prompt = "Provide a response in " . $request->language . " language.\n\n Create personal social post content with my give information" . "\n\n This is content description : " . $request->description . ".\n\n The minimum length of the personal social post content must be " . $maxToken . " words.\n\n" . "\n\n and Create seperate distinct ' . $request->result_quantity . ' results";
        return $prompt;
    }

    private function generateYoutubeVideoDescription($request, $maxToken) {
        $prompt = "Provide a response in " . $request->language . " language.\n\n Create youtube video description with my give information" . "\n\n This is video title : " . $request->video_title . ".\n\n The minimum length of the youtube video description must be " . $maxToken . " words.\n\n" . "\n\n and Create seperate distinct ' . $request->result_quantity . ' results";
        return $prompt;
    }

    private function generateFacebookAd($request, $maxToken) {
        $prompt = "Provide a response in " . $request->language . " language.\n\n Create facebook ads with my give information" . "\n\n This is product name : " . $request->product_name . "\n\n This is product description : " . $request->product_description . ". The minimum length of the facebook ads must be " . $maxToken . " words.\n\n" . "\n\n and Create seperate distinct ' . $request->result_quantity . ' results";
        return $prompt;
    }

    private function generateProductPressRelease($request, $maxToken) {
        $prompt = "Provide a response in " . $request->language . " language.\n\n Create product press release description with my give information" . "\n\n This is product name : " . $request->product_name . "\n\n This is product description : " . $request->product_description . ". The minimum length of the product press release description must be " . $maxToken . " words.\n\n" . "\n\n and Create seperate distinct ' . $request->result_quantity . ' results";
        return $prompt;
    }

    private function generateRealStateSaleDescription($request, $maxToken) {
        $prompt = "Provide a response in " . $request->language . " language.\n\n Create real state sale description with my give information" . "\n\n This is property name : " . $request->property_name . "\n\n This is property description : " . $request->property_description . ". The minimum length of the real state sale description must be " . $maxToken . " words.\n\n" . "\n\n and Create seperate distinct ' . $request->result_quantity . ' results";
        return $prompt;
    }

    private function generateSEOKeywords($request, $maxToken) {
        $prompt = "Provide a response in " . $request->language . " language.\n\n Create SEO keywords for product with my give information" . "\n\n This is product name : " . $request->product_name . ". The minimum length of the SEO keywords must be " . $maxToken . " words.\n\n" . "\n\n and Create seperate distinct ' . $request->result_quantity . ' results";
        return $prompt;
    }

    private function generateMarketingAdHeadline($request, $maxToken) {
        $prompt = "Provide a response in " . $request->language . " language.\n\n Create advertise headline with my give information" . "\n\n This is product name : " . $request->product_name . "\n\n This is product description : " . $request->product_description . ". The minimum length of the advertise headline must be " . $maxToken . " words.\n\n" . "\n\n and Create seperate distinct ' . $request->result_quantity . ' results";
        return $prompt;
    }

    private function generateAmazonProductDescription($request, $maxToken) {
        $prompt = "Provide a response in " . $request->language . " language.\n\n Create Amazon product description with my give information" . "\n\n This is product name : " . $request->product_name . "\n\n This is product description : " . $request->product_description . ". The minimum length of the Amazon product description must be " . $maxToken . " words.\n\n" . "\n\n and Create seperate distinct ' . $request->result_quantity . ' results";
        return $prompt;
    }

    private function generateBlogDescription($request, $maxToken) {
        $prompt = "Provide a response in " . $request->language . " language.\n\n Create blog description with my give information" . "\n\n This is description : " . $request->description . ". The minimum length of the blog description must be " . $maxToken . " words.\n\n" . "\n\n and Create seperate distinct ' . $request->result_quantity . ' results";
        return $prompt;
    }

    private function generateBlogConclusion($request, $maxToken) {
        $prompt = "Provide a response in " . $request->language . " language.\n\n Create blog conclusion with my give information" . "\n\n This is description : " . $request->description . ". The minimum length of the blog conclusion must be " . $maxToken . " words.\n\n" . "\n\n and Create seperate distinct ' . $request->result_quantity . ' results";
        return $prompt;
    }

    private function generateBlogFeatures($request, $maxToken) {
        $prompt = "Provide a response in " . $request->language . " language.\n\n Create blog features with my give information" . "\n\n This is description : " . $request->description . ". The minimum length of the blog features must be " . $maxToken . " words.\n\n" . "\n\n and Create seperate distinct ' . $request->result_quantity . ' results";
        return $prompt;
    }
    private function generateBlogTitle($request, $maxToken) {
        $prompt = "Provide a response in " . $request->language . " language.\n\n Create blog title with my give information" . "\n\n This is description : " . $request->content_description . ". The minimum length of the blog title must be " . $maxToken . " words.\n\n" . "\n\n and Create seperate distinct ' . $request->result_quantity . ' results";
        return $prompt;
    }

    private function generateLinkedinAdHeadline($request, $maxToken) {
        $prompt = "Provide a response in " . $request->language . " language.\n\n Create linkedin ad headline with my give information" . "\n\n This is product name : " . $request->product_name . "\n\n This is product description : " . $request->product_description . ". The minimum length of the linkedin ad headline must be " . $maxToken . " words.\n\n" . "\n\n and Create seperate distinct ' . $request->result_quantity . ' results";
        return $prompt;
    }

    private function generateFacebookAdHeadline($request, $maxToken) {
        $prompt = "Provide a response in " . $request->language . " language.\n\n Create facebook ad headline with my give information" . "\n\n This is product name : " . $request->product_name . "\n\n This is product description : " . $request->product_description . ". The minimum length of the facebook ad headline must be " . $maxToken . " words.\n\n" . "\n\n and Create seperate distinct ' . $request->result_quantity . ' results";
        return $prompt;
    }

    private function generateGoogleAdDescription($request, $maxToken) {
        $prompt = "Provide a response in " . $request->language . " language.\n\n Create google ad description with my give information" . "\n\n This is product name : " . $request->product_name . "\n\n This is product description : " . $request->product_description . ". The minimum length of the google ad description must be " . $maxToken . " words.\n\n" . "\n\n and Create seperate distinct ' . $request->result_quantity . ' results";
        return $prompt;
    }

    private function generateEmailSubject($request, $maxToken) {
        $prompt = "Provide a response in " . $request->language . " language.\n\n Create an email Subject with my give information" . "\n\n This is my description : " . $request->description . ". The minimum length of the email Subject must be " . $maxToken . " words.\n\n" . "\n\n and Create seperate distinct ' . $request->result_quantity . ' results";
        return $prompt;
    }
    private function generateEmailDescription($request, $maxToken) {
        $prompt = "Provide a response in " . $request->language . " language.\n\n Create an email generate with my give information" . "\n\n This is email description : " . $request->email_description . ". The minimum length of the email generate must be " . $maxToken . " words.\n\n" . "\n\n and Create seperate distinct ' . $request->result_quantity . ' results";
        return $prompt;
    }

    private function generateArticleProductDescription($request, $maxToken) {
        $prompt = "Provide a response in " . $request->language . " language.\n\n Create article for product description with my give information" . "\n\n This is description for article: " . $request->product_description . ". The minimum length of the  article for product description must be " . $maxToken . " words.\n\n" . "\n\n and Create seperate distinct ' . $request->result_quantity . ' results";
        return $prompt;
    }

    private function generateArticlePublication($request, $maxToken) {
        $prompt = "Provide a response in " . $request->language . " language.\n\n Create article for publication with my give information" . "\n\n This is description : " . $request->description . ". The minimum length of the article for publication must be " . $maxToken . " words.\n\n" . "\n\n and Create seperate distinct ' . $request->result_quantity . ' results";
        return $prompt;
    }

    private function generateArticle($request, $maxToken) {
        $prompt = "Provide a response in " . $request->language . " language.\n\n Create article with my give information" . "\n\n This is title : " . $request->title . "\n\n This is important keyword : " . $request->important_keyword . ". The minimum length of the article  must be " . $maxToken . " words.\n\n" . "\n\n and Create seperate distinct ' . $request->result_quantity . ' results";
        return $prompt;
    }

    private function generateSEOContent($request, $maxToken) {
        $prompt = "Provide a response in " . $request->language . " language.\n\n Create creative product SEO data" . "\n\n This is product important keyword : " . $request->important_keyword . ". The minimum length of the p product SEO data must be " . $maxToken . " words.\n\n" . "\n\n and Create seperate distinct ' . $request->result_quantity . ' results";
        return $prompt;
    }

    private function generateProductFeatures($request, $maxToken) {
        $prompt = "Provide a response in " . $request->language . " language.\n\n Create creative product features" . "\n\nThis is product name : " . $request->product_name . "\n\n This is product description : " . $request->description . ". The minimum length of the product features must be " . $maxToken . " words.\n\n" . "\n\n and Create seperate distinct ' . $request->result_quantity . ' results";
        return $prompt;
    }

    private function generateProductName($request, $maxToken) {
        $prompt = "Provide a response in " . $request->language . " language.\n\n Create 5 creative product names" . "\n\nThis is my description : " . $request->description . ". The minimum length of the product names must be " . $maxToken . " words.\n\n" . "\n\n and Create seperate distinct ' . $request->result_quantity . ' results";
        return $prompt;
    }

    private function getClickBaitContent($request, $maxToken) {
        $prompt = "Provide a response in " . $request->language . " language.\n\n Write 5 attention-grabbing and sale-generating clickbait titles for a product description" . $request->product_description . " with a minimum length of " . $maxToken . "words. \n\n The titles should be relevant to the product and its target audience.\n\n and Create seperate distinct ' . $request->result_quantity . ' results";
        return $prompt;
    }
    private function generateAdHeadlineContent($request, $maxToken) {
        $prompt = "Provide a response in " . $request->language . " language.\n\n Write a long creative ad headline for the following product. Product name: " . $request->product_name . ". Product description: " . $request->description . ". The minimum length of the headline must be " . $maxToken . " words.\n\n and Create seperate distinct ' . $request->result_quantity . ' results with gap between height 100px";
        return $prompt;
    }
    private function generateParagraphContent($request, $maxToken) {
        $prompt = "I need a paragraph of content for the " . $request->paragraph_description . ".\n\n I need less than " . $maxToken . " words. and this content's language will be " . $request->language . ".\n\n Give me correct spelling and grammar validation with full meaning. \n\n and Create seperate distinct ' . $request->result_quantity . ' results";
        return $prompt;
    }
    private function generateProductDescriptionContent($request, $maxToken) {
        $prompt = "I need the product description for the " . $request->product_name . "\n\ngive me seperate " . $request->result_quantity . " result and it will show minimum gap" . "\n\n." . $request->product_description . " is the simple description of this product.\n\n this description will be " . $request->language . " language.\n\nI need all result will be equal " . $maxToken . " words.\n\n this description will be correct spelling and grammar check";
        return $prompt;
    }
}
