<?php

function bb_bbcode_collection_prepare_content($content)
{


    $parseData=parse_shortcode_data('strong',$content);

    $total=count($parseData);

    for ($i=0; $i < $total; $i++) { 
        $content=str_replace($parseData[$i]['source'],'<strong>'.trim($parseData[$i]['value']).'</strong>',$content);
    }

    
    $parseData=parse_shortcode_data('spoiler',$content);

    $total=count($parseData);

    $newID="";

    $addContent='';

    for ($i=0; $i < $total; $i++) { 

        $newID="ID_".randNumber(8);

        $addContent='
        <div class="collapse block" id="'.$newID.'" style="margin-top:10px;">
        <div class="card card-body">
        '.$parseData[$i]['value'].'
        </div>
        </div>
        ';

        if(count(array_keys($parseData[$i]['attr'])) > 0)
        {
            $content=str_replace($parseData[$i]['source'],'<button class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#'.$newID.'" aria-expanded="false" aria-controls="'.$newID.'"><i class="fas fa-tag"></i> Spoiler: '.strip_tags($parseData[$i]['attr']['value']).'</button>'.$addContent,$content);
        }
        else
        {
            $content=str_replace($parseData[$i]['source'],'<button class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#'.$newID.'" aria-expanded="false" aria-controls="'.$newID.'"><i class="fas fa-tag"></i> Spoiler</button>'.$addContent,$content);
        }
        
    }

    $parseData=parse_shortcode_data('gallery',$content);

    $total=count($parseData);
    $splitImage='';
    $wrap_gallery='';

    $totalLine=0;

    for ($i=0; $i < $total; $i++) { 
        $splitImage=explode("\n",$parseData[$i]['value']);
        
        $totalLine=count($splitImage);

        $wrap_gallery='';

        if($totalLine > 0)
        {
            $wrap_gallery='<div class="fotorama" data-allowfullscreen="true" data-arrows="true" data-click="true" data-fit="cover" data-nav="thumbs" data-swipe="false">';

            for ($k=0; $k < $totalLine; $k++) { 
                if(isset($splitImage[$k][5]))
                {
                    $wrap_gallery.='<img alt="image '.basename($splitImage[$k]).'" class="img-fluid lozad" data-src="'.strip_tags(trim($splitImage[$k])).'" />';
                }
            }
    
            $wrap_gallery.='</div>';
    
            $content=str_replace($parseData[$i]['source'],$wrap_gallery,$content);
        }
    }

    $parseData=parse_shortcode_data('code',$content);

    $total=count($parseData);

    for ($i=0; $i < $total; $i++) { 
        $content=str_replace($parseData[$i]['source'],'<pre class="bb_pre" style="background-color: #f2f2f2;padding:10px;"><code>'.$parseData[$i]['value'].'</code></pre>',$content);
    }

    $parseData=parse_shortcode_data('output',$content);

    $total=count($parseData);

    $card_title='';
    $card_head_align='';

    for ($i=0; $i < $total; $i++) { 

        $card_title='Output';

        $card_head_align='center';

        if(isset($parseData[$i]['attr']['title']))
        {
            $card_title=isset($parseData[$i]['attr']['title'][1])?$parseData[$i]['attr']['title']:$card_title;
        }

        if(isset($parseData[$i]['attr']['align']))
        {
            $card_head_align=isset($parseData[$i]['attr']['align'][1])?$parseData[$i]['attr']['align']:'center';
        }
      
        $content=str_replace($parseData[$i]['source'],'
            <div class="card" style="border: 0px;">
              <h5 class="card-header bg-light" style="font-size: 10pt;text-align: '.$card_head_align.';font-weight: 400;color: #323232!important;background-color:#e5e5e5!important;border: 0px;">'.$card_title.'</h5>
              <div class="card-body" style="background-color:#f2f2f2;font-size: 10pt;">
                '.$parseData[$i]['value'].'
              </div>
            </div>
',$content);
    }

    $parseData=parse_shortcode_data('card',$content);

    $total=count($parseData);

    $card_title='';
    $card_head_align='';

    for ($i=0; $i < $total; $i++) { 

        $card_title='Output';



        $card_head_align='center';

        if(isset($parseData[$i]['attr']['title']))
        {
            $card_title=isset($parseData[$i]['attr']['title'][1])?$parseData[$i]['attr']['title']:$card_title;
        }

        if(isset($parseData[$i]['attr']['align']))
        {
            $card_head_align=isset($parseData[$i]['attr']['align'][1])?$parseData[$i]['attr']['align']:'center';
        }

        $content=str_replace($parseData[$i]['source'],'
            <div class="card" style="border: 0px;">
              <h5 class="card-header bg-light" style="font-size: 10pt;text-align: '.$card_head_align.';font-weight: 400;border: 0px;">'.$card_title.'</h5>
              <div class="card-body" style="background-color:#f2f2f2;font-size: 10pt;">
                '.$parseData[$i]['value'].'
              </div>
            </div>
',$content);
    }

    $parseData=parse_shortcode_data('youtube',$content);

    $total=count($parseData);

    for ($i=0; $i < $total; $i++) { 
        $content=str_replace($parseData[$i]['source'],'<iframe width="560" height="315" src="https://www.youtube.com/embed/'.trim(strip_tags($parseData[$i]['value'])).'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',$content);
    }

    $parseData=parse_shortcode_data('codepen',$content);

    $total=count($parseData);

    for ($i=0; $i < $total; $i++) { 
        $content=str_replace($parseData[$i]['source'],'<iframe height="300" style="width: 100%;" scrolling="no" title="Embed Example Pen" src="https://codepen.io/team/codepen/embed/preview/'.trim(strip_tags($parseData[$i]['value'])).'?default-tab=html%2Cresult&editable=true" frameborder="no" loading="lazy" allowtransparency="true" allowfullscreen="true">
            See the Pen <a href="https://codepen.io/team/codepen/pen/'.trim(strip_tags($parseData[$i]['value'])).'">
            Embed Example Pen</a> by CodePen (<a href="https://codepen.io/team/codepen">@codepen</a>)
            on <a href="https://codepen.io">CodePen</a>.
          </iframe>',$content);
    }

    $parseData=parse_shortcode_data('audio',$content);

    $total=count($parseData);

    for ($i=0; $i < $total; $i++) { 
        $content=str_replace($parseData[$i]['source'],'
        <audio
            controls
            src="'.trim(strip_tags($parseData[$i]['value'])).'">
                Your browser does not support the
                <code>audio</code> element.
        </audio>
        ',$content);
    }

    $parseData=parse_shortcode_data('video',$content);

    $total=count($parseData);

    for ($i=0; $i < $total; $i++) { 
        $content=str_replace($parseData[$i]['source'],'
        <video width="320" height="240" controls>
            <source src="'.trim(strip_tags($parseData[$i]['value'])).'" type="video/mp4">
            <source src="movie.ogg" type="video/ogg">
        Your browser does not support the video tag.
        </video>
        ',$content);
    }


    $parseData=parse_shortcode_data('pastebin',$content);

    $total=count($parseData);

    for ($i=0; $i < $total; $i++) { 
        $content=str_replace($parseData[$i]['source'],'<iframe src="https://pastebin.com/embed_iframe/'.trim(strip_tags($parseData[$i]['value'])).'?theme=dark" style="border:none;width:100%;min-height:400px;"></iframe>',$content);
    }

    $parseData=parse_shortcode_data('jsfiddle',$content);

    $total=count($parseData);

    for ($i=0; $i < $total; $i++) { 
        $content=str_replace($parseData[$i]['source'],'<script async src="'.trim(strip_tags($parseData[$i]['value'])).'/embed/js,html,css,result/dark/"></script>',$content);
    }

    $parseData=parse_shortcode_data('vimeo',$content);

    $total=count($parseData);

    for ($i=0; $i < $total; $i++) { 
        $content=str_replace($parseData[$i]['source'],'<iframe src="https://player.vimeo.com/video/'.trim(strip_tags($parseData[$i]['value'])).'" width="640" height="360" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>',$content);
    }

    $parseData=parse_shortcode_data('dailymotion',$content);

    $total=count($parseData);

    for ($i=0; $i < $total; $i++) { 
        $content=str_replace($parseData[$i]['source'],'<div style="position:relative;padding-bottom:56.25%;height:0;overflow:hidden;"> <iframe style="width:100%;height:100%;position:absolute;left:0px;top:0px;overflow:hidden" frameborder="0" type="text/html" src="https://www.dailymotion.com/embed/video/'.trim(strip_tags($parseData[$i]['value'])).'?autoplay=1" width="100%" height="100%" allowfullscreen allow="autoplay"> </iframe> </div>',$content);
    }

    $parseData=parse_shortcode_data('quote',$content);

    $total=count($parseData);

    for ($i=0; $i < $total; $i++) { 
        $content=str_replace($parseData[$i]['source'],'<blockquote>'.$parseData[$i]['value'].'</blockquote>',$content);
    }

    $parseData=parse_shortcode_data('s',$content);

    $total=count($parseData);

    for ($i=0; $i < $total; $i++) { 
        $content=str_replace($parseData[$i]['source'],'<s>'.trim($parseData[$i]['value']).'</s>',$content);
    }

    $parseData=parse_shortcode_data('url',$content);

    $total=count($parseData);

    for ($i=0; $i < $total; $i++) { 
        if(count(array_keys($parseData[$i]['attr'])) > 0)
        {
            $content=str_replace($parseData[$i]['source'],'<a href="'.trim(strip_tags($parseData[$i]['attr']['value'])).'" target="_blank">'.$parseData[$i]['value'].'</a>',$content);
        }
        else
        {
            $content=str_replace($parseData[$i]['source'],'<a href="'.trim(strip_tags($parseData[$i]['value'])).'" target="_blank">'.trim(strip_tags($parseData[$i]['value'])).'</a>',$content);
        }
        
    }

    
    $parseData=parse_shortcode_data('u',$content);

    $total=count($parseData);

    for ($i=0; $i < $total; $i++) { 
        $content=str_replace($parseData[$i]['source'],'<u>'.$parseData[$i]['value'].'</u>',$content);
    }

    $parseData=parse_shortcode_data('email',$content);

    $total=count($parseData);

    for ($i=0; $i < $total; $i++) { 
        $content=str_replace($parseData[$i]['source'],'<a href="mailto:'.trim(strip_tags($parseData[$i]['value'])).'">'.$parseData[$i]['value'].'</a>',$content);
    }

    $parseData=parse_shortcode_data('img',$content);

    $total=count($parseData);

    for ($i=0; $i < $total; $i++) { 
        $content=str_replace($parseData[$i]['source'],'<img alt="Image '.basename($parseData[$i]['value']).'" class="img-fluid lozad" data-src="'.strip_tags(trim($parseData[$i]['value'])).'">',$content);
    }

    $parseData=parse_shortcode_data('i',$content);

    $total=count($parseData);

    for ($i=0; $i < $total; $i++) { 
        $content=str_replace($parseData[$i]['source'],'<i>'.$parseData[$i]['value'].'</i>',$content);
    }

    $parseData=parse_shortcode_data('b',$content);

    $total=count($parseData);

    for ($i=0; $i < $total; $i++) { 
        $content=str_replace($parseData[$i]['source'],'<strong>'.$parseData[$i]['value'].'</strong>',$content);
    }

    $parseData=parse_shortcode_data('left',$content);

    $total=count($parseData);

    for ($i=0; $i < $total; $i++) { 
        $content=str_replace($parseData[$i]['source'],'<div style="width:100%;text-align:left;">'.$parseData[$i]['value'].'</div>',$content);
    }

    $parseData=parse_shortcode_data('right',$content);

    $total=count($parseData);

    for ($i=0; $i < $total; $i++) { 
        $content=str_replace($parseData[$i]['source'],'<div style="width:100%;text-align:right;">'.$parseData[$i]['value'].'</div>',$content);
    }

    $parseData=parse_shortcode_data('center',$content);

    $total=count($parseData);

    for ($i=0; $i < $total; $i++) { 
        $content=str_replace($parseData[$i]['source'],'<div style="width:100%;text-align:center;">'.$parseData[$i]['value'].'</div>',$content);
    }

    $parseData=parse_shortcode_data('plain',$content);

    $total=count($parseData);

    for ($i=0; $i < $total; $i++) { 
        $content=str_replace($parseData[$i]['source'],'<span>'.htmlspecialchars($parseData[$i]['value']).'</span>',$content);
    }

    $parseData=parse_shortcode_data('table',$content);

    $total=count($parseData);

    for ($i=0; $i < $total; $i++) { 
        $content=str_replace($parseData[$i]['source'],'<table class="table table-striped">'.$parseData[$i]['value'].'</table>',$content);
    }

    $parseData=parse_shortcode_data('thead',$content);

    $total=count($parseData);

    for ($i=0; $i < $total; $i++) { 
        $content=str_replace($parseData[$i]['source'],'<thead>'.$parseData[$i]['value'].'</thead>',$content);
    }
    $parseData=parse_shortcode_data('tbody',$content);

    $total=count($parseData);

    for ($i=0; $i < $total; $i++) { 
        $content=str_replace($parseData[$i]['source'],'<tbody>'.$parseData[$i]['value'].'</tbody>',$content);
    }
    $parseData=parse_shortcode_data('tfooter',$content);

    $total=count($parseData);

    for ($i=0; $i < $total; $i++) { 
        $content=str_replace($parseData[$i]['source'],'<tfooter>'.$parseData[$i]['value'].'</tfooter>',$content);
    }
    $parseData=parse_shortcode_data('tr',$content);

    $total=count($parseData);

    for ($i=0; $i < $total; $i++) { 
        $content=str_replace($parseData[$i]['source'],'<tr>'.$parseData[$i]['value'].'</tr>',$content);
    }

    $parseData=parse_shortcode_data('td',$content);

    $total=count($parseData);

    for ($i=0; $i < $total; $i++) { 
        $content=str_replace($parseData[$i]['source'],'<td>'.$parseData[$i]['value'].'</td>',$content);
    }

    $parseData=parse_shortcode_data('color',$content);

    $total=count($parseData);

    for ($i=0; $i < $total; $i++) { 
        $content=str_replace($parseData[$i]['source'],'<span style="color:'.$parseData[$i]['attr']['value'].'">'.$parseData[$i]['value'].'</span>',$content);
    }

    $parseData=parse_shortcode_data('size',$content);

    $total=count($parseData);

    for ($i=0; $i < $total; $i++) { 
        $content=str_replace($parseData[$i]['source'],'<span style="font-size:'.$parseData[$i]['attr']['value'].'pt;">'.$parseData[$i]['value'].'</span>',$content);
    }

    $parseData=parse_shortcode_data('download',$content);

    $total=count($parseData);

    $attr_title='';

    for ($i=0; $i < $total; $i++) { 

        $attr_title='Download';

        if(isset($parseData[$i]['attr']) && isset($parseData[$i]['attr']['title']) && isset($parseData[$i]['attr']['title'][2]))
        {
            $attr_title=$parseData[$i]['attr']['title'];
        }

        $content=str_replace($parseData[$i]['source'],'
        <div class="input-group mb-3">
          <a class="btn btn-success" href="'.trim(strip_tags($parseData[$i]['value'])).'" target="_blank"><i class="fas fa-file-download"></i> '.$attr_title.'</a>
        </div>',$content);
    }

    $parseData=parse_shortcode_data('website',$content);

    $total=count($parseData);

    $attr_title='';

    for ($i=0; $i < $total; $i++) { 

        $attr_title='Website';

        if(isset($parseData[$i]['attr']) && isset($parseData[$i]['attr']['title']) && isset($parseData[$i]['attr']['title'][2]))
        {
            $attr_title=$parseData[$i]['attr']['title'];
        }

        $content=str_replace($parseData[$i]['source'],'
        <div class="input-group mb-3">
          <a class="btn btn-success" href="'.trim(strip_tags($parseData[$i]['value'])).'" target="_blank"><i class="fas fa-link"></i> '.$attr_title.'</a>
        </div>',$content);
    }    
    

    $parseData=parse_shortcode_data('buy',$content);

    $total=count($parseData);

    $attr_title='';
    $attr_price='';

    for ($i=0; $i < $total; $i++) { 

        $attr_title='Buy Now';

        $attr_price='';

        if(isset($parseData[$i]['attr']) && isset($parseData[$i]['attr']['title']) && isset($parseData[$i]['attr']['title'][2]))
        {
            $attr_title=$parseData[$i]['attr']['title'];
        }
        if(isset($parseData[$i]['attr']) && isset($parseData[$i]['attr']['price']) && isset($parseData[$i]['attr']['price'][1]))
        {
            $attr_price=' ('.$parseData[$i]['attr']['price'].')';
        }

        $content=str_replace($parseData[$i]['source'],'
        <div class="input-group mb-3">
          <a class="btn btn-success" href="'.trim(strip_tags($parseData[$i]['value'])).'" target="_blank"><i class="fas fa-money-check-alt"></i> '.$attr_title.$attr_price.'</a>
        </div>',$content);
    }

    return $content;
}
