    <script src="{{asset('evendor/jquery/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/inputmask.bundle.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/anim.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/search.js')}}"></script>

    <script>
      $(document).ready(function(){
          $("#ch").inputmask("999999");
          $("#det").inputmask("999999");
          $("#mec").inputmask("999999");
        });
    </script>
    <script>
        $("#hide").click(function(){
          $("input").show("slow", "swing");
          });
          $("#hide").dblclick(function(){
          $("input").hide("slow"); /*,"swing*/
        });
    </script>
</body>    
