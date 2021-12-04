
<style>
.select2-container .select2-selection--single
{
  height: 38px;
}
  </style>
  
 <link href="<?php echo THEMES_URL;?>bb_simple/assets/fotorama/fotorama.css" rel="stylesheet" />
 <script src="<?php echo THEMES_URL;?>bb_simple/assets/fotorama/fotorama.js"></script>

  <div class='container  mt-20px pl-0px pr-0px' >
    <main>
        <!-- row -->
        <div class='row'>
        <!-- left -->
        <div class='col-lg-12 '>
        <div class="card text-dark bg-light mb-3" style=" ">
            <div class="card-header card-header-forum">BBCode Checksheet</div>
            <div class="card-body">
                
            <table class="table " style="border:1px solid #000;">
            <thead>
              <tr style="background-color: #ffcd39;font-size: 11pt;">
                <td style="border:1px solid #000;">Input</td>
                <td class="" style="border:1px solid #000;">Output</td>
              </tr>
            </thead>
    
            <tbody style="font-size: 11pt;">
                <tr>
                    <td style="border:1px solid #000;">[b]bold[/b] text</td>
                    <td class="" style="border:1px solid #000;"><strong>bold</strong> text</td>
                </tr>      
                <tr>
                    <td style="border:1px solid #000;">[i]italic[/i] text</td>
                    <td class="" style="border:1px solid #000;"><i>italic</i> text</td>
                </tr>      
                <tr>
                    <td style="border:1px solid #000;">[u]underlined[/u] text</td>
                    <td class="" style="border:1px solid #000;"><u>underlined</u> text</td>
                </tr>      
                <tr>
                    <td style="border:1px solid #000;">[s]struck-through[/s] text</td>
                    <td class="" style="border:1px solid #000;"><s>struck-through</s> text</td>
                </tr>      
                <tr>
                    <td style="border:1px solid #000;">Example [color=red]color[/color] text</td>
                    <td class="" style="border:1px solid #000;">Example <span style='color:red;'>color</span> text</td>
                </tr>      
                <tr>
                    <td style="border:1px solid #000;">Example [size=21]font size[/color] text</td>
                    <td class="" style="border:1px solid #000;">Example <span style='font-size:21pt;'>font size</span> text</td>
                </tr>      
                <tr>
                    <td style="border:1px solid #000;">Example [email]text@gmail.com[/email]</td>
                    <td class="" style="border:1px solid #000;">Example <a href="mailto:text@gmail.com">text@gmail.com</a></td>
                </tr>      
                <tr>
                    <td style="border:1px solid #000;">Example [url]http://google.com[/url]</td>
                    <td class="" style="border:1px solid #000;">Example <a href="http://google.com">http://google.com</a> text</td>
                </tr>      
                <tr>
                    <td style="border:1px solid #000;">Example [url=http://google.com]Google site[/url]</td>
                    <td class="" style="border:1px solid #000;">Example <a href="http://google.com">Google site</a> text</td>
                </tr>      
                <tr>
                    <td style="border:1px solid #000;">Example [img]http://img_url_here[/img] text</td>
                    <td class="" style="border:1px solid #000;"></td>
                </tr>      
                <tr>
                    <td style="border:1px solid #000;">[left]Left content[/left]</td>
                    <td class="" style="border:1px solid #000;"><div style='text-align:left;'>Left content</div></td>
                </tr>      
                <tr>
                    <td style="border:1px solid #000;">[right]Right content[/right]</td>
                    <td class="" style="border:1px solid #000;"><div style='text-align:right;'>Right content</div></td>
                </tr>      
                <tr>
                    <td style="border:1px solid #000;">[center]Center content[/center]</td>
                    <td class="" style="border:1px solid #000;"><div style='text-align:center;'>Center content</div></td>
                </tr>      
                <tr>
                    <td style="border:1px solid #000;">Example [plain]<?php echo htmlspecialchars('<b>Test</b>');?>[/plain] text</td>
                    <td class="" style="border:1px solid #000;">Example <?php echo htmlspecialchars('<b>Test</b>');?> text</td>
                </tr>      
                <tr>
                    <td style="border:1px solid #000;">Example [audio]Audio url[/audio] text</td>
                    <td class="" style="border:1px solid #000;">
                                <audio
                                    controls
                                    src="/media/cc0-audio/t-rex-roar.mp3">
                                        Your browser does not support the
                                        <code>audio</code> element.
                                </audio>
                                       
                    </td>
                </tr>      
                <tr>
                    <td style="border:1px solid #000;">Example [video]Video url[/video] text</td>
                    <td class="" style="border:1px solid #000;">
                        <video width="320" height="240" controls>
                        <source src="movie.mp4" type="video/mp4">
                        <source src="movie.ogg" type="video/ogg">
                        Your browser does not support the video tag.
                        </video>
                                       
                    </td>
                </tr>      
                <tr>
                    <td style="border:1px solid #000;">Example [quote]Test[/quote] text</td>
                    <td class="" style="border:1px solid #000;"><blockquote>Test</blockquote></td>
                </tr>      
                <tr>
                    <td style="border:1px solid #000;">Example [code]Test[/code] text</td>
                    <td class="" style="border:1px solid #000;"><blockquote>Test</blockquote></td>
                </tr>      
                <tr>
                    <td style="border:1px solid #000;">Example [spoiler]Test[/spoiler] text</td>
                    <td class="" style="border:1px solid #000;">
                    <button class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#spoiler_001" aria-expanded="false" aria-controls="spoiler_001"><i class="fas fa-tag"></i> Spoiler</button>
                        <div class="collapse block" id="spoiler_001" style="margin-top:10px;">
                        <div class="card card-body">
                        Test
                        </div>
                        </div>                
                    </td>
                </tr>      
                <tr>
                    <td style="border:1px solid #000;">Example [spoiler=Spoiler Title]Test[/spoiler] text</td>
                    <td class="" style="border:1px solid #000;">
                    <button class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#spoiler_002" aria-expanded="false" aria-controls="spoiler_002"><i class="fas fa-tag"></i> Spoiler: Spoiler Title</button>
                        <div class="collapse block" id="spoiler_002" style="margin-top:10px;">
                        <div class="card card-body">
                        Test
                        </div>
                        </div>                
                    </td>
                </tr>      
                <tr>
                    <td style="border:1px solid #000;">Example [youtube]video_id[/youtube]</td>
                    <td class="" style="border:1px solid #000;"></td>
                </tr>      
                <tr>
                    <td style="border:1px solid #000;">Example [vimeo]video_id[/vimeo]</td>
                    <td class="" style="border:1px solid #000;"></td>
                </tr>      
                <tr>
                    <td style="border:1px solid #000;">Example [dailymotion]video_id[/dailymotion]</td>
                    <td class="" style="border:1px solid #000;"></td>
                </tr>      
                <tr>
                    <td style="border:1px solid #000;">Example [you]</td>
                    <td class="" style="border:1px solid #000;">Admin</td>
                </tr>      
                <tr>
                    <td style="border:1px solid #000;">Example [day]</td>
                    <td class="" style="border:1px solid #000;">Admin</td>
                </tr>      
                <tr>
                    <td style="border:1px solid #000;">Example [random_number][/random_number]: Create random number 0 to 9</td>
                    <td class="" style="border:1px solid #000;">1</td>
                </tr>      
                <tr>
                    <td style="border:1px solid #000;">Example [random_number=<span style='color:red;'>6</span>][/random_number]: Create random number have 6 characters</td>
                    <td class="" style="border:1px solid #000;">100000</td>
                </tr>      
                <tr>
                    <td style="border:1px solid #000;">Example [random]Line 1<span style='color:red;'>::break::</span>Line2<span style='color:red;'>::break::</span>Line3[/random]: Show a random line</td>
                    <td class="" style="border:1px solid #000;">Line 1</td>
                </tr>      
                <tr>
                    <td style="border:1px solid #000;">Example [hide target="reply"]Content hide[/hide]: Hide content until user reply thread</td>
                    <td class="" style="border:1px solid #000;">*****Hide Content*****</td>
                </tr>      
                <tr>
                    <td style="border:1px solid #000;">Example [hide target="reaction"]Content hide[/hide]: Hide content until user create reaction of thread</td>
                    <td class="" style="border:1px solid #000;">*****Hide Content*****</td>
                </tr>      
                <tr>
                    <td style="border:1px solid #000;">Example [hide target="group_name:Administrator"]Content hide[/hide]: Hide content until user group of user that is Administrator</td>
                    <td class="" style="border:1px solid #000;">*****Hide Content*****</td>
                </tr>      
                <tr>
                    <td style="border:1px solid #000;">Example [hide target="rank_name:Pro"]Content hide[/hide]: Hide content until rank of user that is Pro</td>
                    <td class="" style="border:1px solid #000;">*****Hide Content*****</td>
                </tr>      
                <tr>
                    <td style="border:1px solid #000;">Example [hide target="thread_more_than:10"]Content hide[/hide]: Hide content until user have more than 10 threads</td>
                    <td class="" style="border:1px solid #000;">*****Hide Content*****</td>
                </tr>      
                <tr>
                    <td style="border:1px solid #000;">Example [hide target="post_more_than:10"]Content hide[/hide]: Hide content until user have more than 10 replies</td>
                    <td class="" style="border:1px solid #000;">*****Hide Content*****</td>
                </tr>      
                <tr>
                    <td style="border:1px solid #000;">Example [hide target="point_more_than:10"]Content hide[/hide]: Hide content until user have more than 10 points</td>
                    <td class="" style="border:1px solid #000;">*****Hide Content*****</td>
                </tr>      
                <tr>
                    <td style="border:1px solid #000;">Example [hide target="followers_more_than:10"]Content hide[/hide]: Hide content until user have more than 10 followers</td>
                    <td class="" style="border:1px solid #000;">*****Hide Content*****</td>
                </tr>      
                <tr>
                    <td style="border:1px solid #000;">Example [hide target="reactions_more_than:10"]Content hide[/hide]: Hide content until user have more than 10 reactions</td>
                    <td class="" style="border:1px solid #000;">*****Hide Content*****</td>
                </tr>      
                <tr>
                    <td style="border:1px solid #000;">Example [hide target="day:1"]Content hide[/hide]: Hide content until today equal = 1</td>
                    <td class="" style="border:1px solid #000;">*****Hide Content*****</td>
                </tr>      
                <tr>
                    <td style="border:1px solid #000;">Example [hide target="month:9"]Content hide[/hide]: Hide content until this month equal = 9</td>
                    <td class="" style="border:1px solid #000;">*****Hide Content*****</td>
                </tr>      
                <tr>
                    <td style="border:1px solid #000;">Example [hide target="year:2021"]Content hide[/hide]: Hide content until this year equal = 2021</td>
                    <td class="" style="border:1px solid #000;">*****Hide Content*****</td>
                </tr>      
                <tr>
                    <td style="border:1px solid #000;">Example [hide target="hour:15"]Content hide[/hide]: Hide content until this hour equal = 15</td>
                    <td class="" style="border:1px solid #000;">*****Hide Content*****</td>
                </tr>      
                <tr>
                    <td style="border:1px solid #000;">Example [hide target="minute:15"]Content hide[/hide]: Hide content until this minute equal = 15</td>
                    <td class="" style="border:1px solid #000;">*****Hide Content*****</td>
                </tr>                  

                <tr>
                    <td style="border:1px solid #000;">Example [hide id="1" target="points:15"]Content hide[/hide]: Hide content until another user click to Pay 15 Points</td>
                    <td class="" style="border:1px solid #000;"><div class="btn-group" role="group" aria-label="Basic example">
                              <button type="button" class="btn btn-warning"><i class="fa fa-file-invoice-dollar"></i> Pay 15 points for view hidden content </button>
                            </div></td>
                </tr>                 
                <tr>
                    <td style="border:1px solid #000;">Example [hide id="1" target="price:15"]Content hide[/hide]: Hide content until another user click to Pay 15 unit</td>
                    <td class="" style="border:1px solid #000;"><div class="btn-group" role="group" aria-label="Basic example">
                              <button type="button" class="btn btn-warning "><i class="fa fa-file-invoice-dollar"></i> Pay 15 unit for view hidden content </button>
                            </div></td>
                </tr>      
                <tr>
                    <td style="border:1px solid #000;">Example [codepen]Pen ID[/codepen]: Embed codepen data into post content</td>
                    <td class="" style="border:1px solid #000;">
                        <iframe height="300" style="width: 100%;" scrolling="no" title="Embed Example Pen" src="https://codepen.io/team/codepen/embed/EVdVpQ?default-tab=html%2Cresult" frameborder="no" loading="lazy" allowtransparency="true" allowfullscreen="true">
                        See the Pen <a href="https://codepen.io/team/codepen/pen/EVdVpQ">
                        Embed Example Pen</a> by CodePen (<a href="https://codepen.io/team/codepen">@codepen</a>)
                        on <a href="https://codepen.io">CodePen</a>.
                        </iframe>                
                    </td>
                </tr>      
                <tr>
                    <td style="border:1px solid #000;">Example [jsfiddle]Url[/jsfiddle]: Embed jsfiddle data into post content</td>
                    <td class="" style="border:1px solid #000;">
                        <script async src="//jsfiddle.net/afabbro/vrVAP/embed/js,html,css,result/dark/"></script>               
                    </td>
                </tr>      
                <tr>
                    <td style="border:1px solid #000;">Example [pastebin]Pastebin note id[/pastebin]: Embed pastebin data into post content</td>
                    <td class="" style="border:1px solid #000;">
                        <iframe src="https://pastebin.com/embed_iframe/NzMCT4eb?theme=dark" style="border:none;width:100%"></iframe>    
                    </td>
                </tr>      
                <tr>
                    <td style="border:1px solid #000;">Example [gallery]https://site.com/1.jpg<br>https://site.com/2.jpg<br>https://site.com/3.jpg<br>[/gallery]: Create gallery</td>
                    <td class="" style="border:1px solid #000;">
                    <div class="fotorama" data-allowfullscreen="true" data-arrows="true" data-click="true" data-fit="cover" data-nav="thumbs" data-swipe="false">
                    <img src="<?php echo SITE_URL;?>contents/themes/bb_simple/assets/fotorama/1.jpg" /> 
                    <img src="<?php echo SITE_URL;?>contents/themes/bb_simple/assets/fotorama/2.jpg" /> 
                    <img src="<?php echo SITE_URL;?>contents/themes/bb_simple/assets/fotorama/3.jpg" /> 
                    <img src="<?php echo SITE_URL;?>contents/themes/bb_simple/assets/fotorama/4.jpg" /> 
                    <img src="<?php echo SITE_URL;?>contents/themes/bb_simple/assets/fotorama/5.jpg" /> 
                    </div>
    
                    </td>
                </tr>      
                   
            </tbody>
          </table>
        
            </div>
            </div>
            
        </div>
        <!-- left -->
        </div>
        <!-- row -->

    </main>
</div>
<!-- container -->


  <script>
  

  </script>
  