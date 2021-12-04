    <!-- bbcode -->
    <div class="wrap_bbcodes_img">
      <img src="<?php echo SITE_URL?>contents/plugins/bulletinboard/images/bbcode.png" class="btn-show-bbcode-management" style="cursor: pointer;position: fixed;top:40%;left:0px;" />
      <script>
   
      $(document).on('click','.btn-show-bbcode-management',function(){
        $('#modalBBCode').modal('show');
      });   
      $(document).on('click','.btn-add-bbcode',function(){
        var target=$(this).attr('data-target');
        var useValue=$(this).attr('data-usevalue');
        var attr=$(this).attr('data-attr');

        var result='';

        var splitAttr='';
        var dataAttr='';

        if(typeof attr!='undefined' && attr.length > 2)
        {
          splitAttr=attr.split(',');

          dataAttr=' ';

          var total=splitAttr.length;

          for (var i = 0; i < total; i++) {
            dataAttr+=splitAttr[i]+'="" ';
          }
        }


        if(typeof useValue=='undefined')
        {
          useValue='yes';
        }

        if(useValue=='yes')
        {

          result='['+target+dataAttr+']<br/><br/>[/'+target+']';
        }
        else
        {
          result='['+target+dataAttr+']';
        }
        
        CKEDITOR.instances.editor.insertHtml(result);
        $('#modalBBCode').modal('hide');
      });
      </script>
    </div>
    <!-- bbcode -->

    <!-- modal -->
    <div class="modal fade" id="modalBBCode" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">List BBCode</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
             <button type="button" class="btn btn-primary btn-add-bbcode mb-10px" data-target="s" data-usevalue="yes">[strike throught]</button>
             <button type="button" class="btn btn-primary btn-add-bbcode mb-10px" data-target="i" data-usevalue="yes">[italic]</button>
             <button type="button" class="btn btn-primary btn-add-bbcode mb-10px" data-target="b" data-usevalue="yes">[bold]</button>
             <button type="button" class="btn btn-primary btn-add-bbcode mb-10px" data-target="u" data-usevalue="yes">[underline]</button>
             <button type="button" class="btn btn-primary btn-add-bbcode mb-10px" data-target="strong" data-usevalue="yes">[strong]</button>
             <button type="button" class="btn btn-primary btn-add-bbcode mb-10px" data-target="email" data-usevalue="yes">[email]</button>
             <button type="button" class="btn btn-primary btn-add-bbcode mb-10px" data-target="img" data-usevalue="yes">[img]</button>
             <button type="button" class="btn btn-primary btn-add-bbcode mb-10px" data-target="url" data-usevalue="yes">[url]</button>
             <button type="button" class="btn btn-primary btn-add-bbcode mb-10px" data-target="left" data-usevalue="yes">[left]</button>
             <button type="button" class="btn btn-primary btn-add-bbcode mb-10px" data-target="right" data-usevalue="yes">[right]</button>
             <button type="button" class="btn btn-primary btn-add-bbcode mb-10px" data-target="center" data-usevalue="yes">[center]</button>
             <button type="button" class="btn btn-primary btn-add-bbcode mb-10px" data-target="plain" data-usevalue="yes">[plain]</button>
             <button type="button" class="btn btn-primary btn-add-bbcode mb-10px" data-target="table" data-usevalue="yes">[table]</button>
             <button type="button" class="btn btn-primary btn-add-bbcode mb-10px" data-target="thead" data-usevalue="yes">[thead]</button>
             <button type="button" class="btn btn-primary btn-add-bbcode mb-10px" data-target="tbody" data-usevalue="yes">[tbody]</button>
             <button type="button" class="btn btn-primary btn-add-bbcode mb-10px" data-target="tfooter" data-usevalue="yes">[tfooter]</button>
             <button type="button" class="btn btn-primary btn-add-bbcode mb-10px" data-target="tr" data-usevalue="yes">[tr]</button>
             <button type="button" class="btn btn-primary btn-add-bbcode mb-10px" data-target="td" data-usevalue="yes">[td]</button>
             <button type="button" class="btn btn-primary btn-add-bbcode mb-10px" data-target="color" data-usevalue="yes">[color]</button>
             <button type="button" class="btn btn-primary btn-add-bbcode mb-10px" data-target="size" data-usevalue="yes">[size]</button>
             <button type="button" class="btn btn-primary btn-add-bbcode mb-10px" data-target="gallery" data-usevalue="yes">[gallery]</button>
             <button type="button" class="btn btn-primary btn-add-bbcode mb-10px" data-target="code" data-usevalue="yes">[code]</button>
             <button type="button" class="btn btn-primary btn-add-bbcode mb-10px" data-target="output" data-usevalue="yes" data-attr="title,align">[output]</button>
             <button type="button" class="btn btn-primary btn-add-bbcode mb-10px" data-target="card" data-usevalue="yes" data-attr="title,align">[card]</button>
             <button type="button" class="btn btn-primary btn-add-bbcode mb-10px" data-target="download" data-usevalue="yes" data-attr="title">[download]</button>
             <button type="button" class="btn btn-primary btn-add-bbcode mb-10px" data-target="buy" data-usevalue="yes" data-attr="title,price">[buy]</button>
             <button type="button" class="btn btn-primary btn-add-bbcode mb-10px" data-target="website" data-usevalue="yes" data-attr="title">[website]</button>
             <button type="button" class="btn btn-primary btn-add-bbcode mb-10px" data-target="random" data-usevalue="yes">[random]</button>
             <button type="button" class="btn btn-primary btn-add-bbcode mb-10px" data-target="random_number" data-usevalue="yes">[random_number]</button>
             <button type="button" class="btn btn-primary btn-add-bbcode mb-10px" data-target="spoiler" data-usevalue="yes" data-attr="value">[spoiler]</button>
             <button type="button" class="btn btn-primary btn-add-bbcode mb-10px" data-target="quote" data-usevalue="yes">[quote]</button>
             <button type="button" class="btn btn-primary btn-add-bbcode mb-10px" data-target="youtube" data-usevalue="yes">[youtube]</button>
             <button type="button" class="btn btn-primary btn-add-bbcode mb-10px" data-target="codepen" data-usevalue="yes">[codepen]</button>
             <button type="button" class="btn btn-primary btn-add-bbcode mb-10px" data-target="audio" data-usevalue="yes">[audio]</button>
             <button type="button" class="btn btn-primary btn-add-bbcode mb-10px" data-target="video" data-usevalue="yes">[video]</button>
             <button type="button" class="btn btn-primary btn-add-bbcode mb-10px" data-target="pastebin" data-usevalue="yes">[pastebin]</button>
             <button type="button" class="btn btn-primary btn-add-bbcode mb-10px" data-target="jsfiddle" data-usevalue="yes">[jsfiddle]</button>
             <button type="button" class="btn btn-primary btn-add-bbcode mb-10px" data-target="vimeo" data-usevalue="yes">[vimeo]</button>
             <button type="button" class="btn btn-primary btn-add-bbcode mb-10px" data-target="dailymotion" data-usevalue="yes">[dailymotion]</button>

             <?php load_hook('bb_bbcode_html_list');?>
             
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-danger" data-bs-dismiss="modal"><i class='fas fa-times'></i> Close</button>
          </div>
        </div>
      </div>
    </div>
    <!-- modal -->   