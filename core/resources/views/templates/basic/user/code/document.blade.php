@php
    
    $result = $code->result;
    $needle = '```';
    $lastPos = 0;
    $positions = [];
    
    while (($lastPos = strpos($result, $needle, $lastPos)) !== false) {
        $positions[] = $lastPos;
        $lastPos = $lastPos + strlen($needle);
    }
    
    $prevPosition = 0;
    $stringArray = [];
    
    foreach ($positions as $position) {
        $substring = substr($result, $prevPosition, $position - $prevPosition);
        $stringArray[] = $substring;
        $prevPosition = $position;
    }
    
    $output = '';
    $isCode = 0;
    
    foreach ($stringArray as $string) {
        if ($isCode) {
            $lines = explode("\n", trim($string));
            $language = array_shift($lines);
            $languageName = str_replace('```', '', $language);
    
            $output .=
                '<div class="chat-box">
        <div class="chat-code-header">
          <span class="language-name">' .
                @$languageName .
                '</span>
        </div>
        <div class="chat-code">
          <pre><code class="language-' .
                @$languageName .
                '">' .
                htmlspecialchars(implode("\n", $lines)) .
                '</code></pre>
        </div>
      </div>';
        } else {
            $output .=
                '<div class="chat-box">
                      <div class="chat-message">' .
                str_replace('```', '', $string) .
                '</div>
                    </div>';
        }
        $isCode = !$isCode;
    }
    
    echo $output;
@endphp
