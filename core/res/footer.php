</section>
    <!--main content end-->
  </section>
<script src="<?= PROOT ?>js/jquery.js"></script>
  <script src="<?= PROOT ?>js/jquery-ui-1.10.4.min.js"></script>
  <script src="<?= PROOT ?>js/jquery-1.8.3.min.js"></script>
  <script type="text/javascript" src="<?= PROOT ?>js/jquery-ui-1.9.2.custom.min.js"></script>
  <script src="<?= PROOT ?>js/bootstrap.min.js"></script>
  <script src="<?= PROOT ?>js/jquery.scrollTo.min.js"></script>
  <script src="<?= PROOT ?>js/jquery.nicescroll.js" type="text/javascript"></script>
  <script src="<?= PROOT ?>assets/jquery-knob/js/jquery.knob.js"></script>
  <script src="<?= PROOT ?>js/jquery.sparkline.js" type="text/javascript"></script>
  <script src="<?= PROOT ?>assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
  <script src="<?= PROOT ?>js/owl.carousel.js"></script>
  <script src="<?= PROOT ?>js/fullcalendar.min.js"></script>
    <script src="<?= PROOT ?>assets/fullcalendar/fullcalendar/fullcalendar.js"></script>
    <script src="<?= PROOT ?>js/calendar-custom.js"></script>
    <script src="<?= PROOT ?>js/jquery.rateit.min.js"></script>
    <script src="<?= PROOT ?>js/jquery.customSelect.min.js"></script>
    <script src="<?= PROOT ?>assets/chart-master/Chart.js"></script>
    <script src="<?= PROOT ?>js/scripts.js"></script>
    <script src="<?= PROOT ?>js/sparkline-chart.js"></script>
    <script src="<?= PROOT ?>js/easy-pie-chart.js"></script>
    <script src="<?= PROOT ?>js/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?= PROOT ?>js/jquery-jvectormap-world-mill-en.js"></script>
    <script src="<?= PROOT ?>js/xcharts.min.js"></script>
    <script src="<?= PROOT ?>js/jquery.autosize.min.js"></script>
    <script src="<?= PROOT ?>js/jquery.placeholder.min.js"></script>
    <script src="<?= PROOT ?>js/gdp-data.js"></script>
    <script src="<?= PROOT ?>js/morris.min.js"></script>
    <script src="<?= PROOT ?>js/sparklines.js"></script>
    <script src="<?= PROOT ?>js/charts.js"></script>
    <script src="<?= PROOT ?>js/jquery.slimscroll.min.js"></script>
    <script>
      //knob
      $(function() {
        $(".knob").knob({
          'draw': function() {
            $(this.i).val(this.cv + '%')
          }
        })
      });

      //carousel
      $(document).ready(function() {
        $("#owl-slider").owlCarousel({
          navigation: true,
          slideSpeed: 300,
          paginationSpeed: 400,
          singleItem: true

        });
      });

      //custom select box

      $(function() {
        $('select.styled').customSelect();
      });

      /* ---------- Map ---------- */
      $(function() {
        $('#map').vectorMap({
          map: 'world_mill_en',
          series: {
            regions: [{
              values: gdpData,
              scale: ['#000', '#000'],
              normalizeFunction: 'polynomial'
            }]
          },
          backgroundColor: '#eef3f7',
          onLabelShow: function(e, el, code) {
            el.html(el.html() + ' (GDP - ' + gdpData[code] + ')');
          }
        });
      });
    </script>

</body>

</html>
