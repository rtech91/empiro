<style type="text/css">
circle {
  fill: #ce3838;
  stroke: #53d900;
  transition: stroke-dasharray .3s ease;
}

svg {
  margin: 0 auto;
  transform: rotate(-90deg);
  background: #ce3838;
  border-radius: 50%;
  display: block;
}
</style>
<figure>
  <figcaption>
    Percentage of passed questions in test
  </figcaption>
  
  <div class="buttons"></div>

  <svg width="100" height="100" class="chart">
    <circle r="25" cx="50" cy="50" stroke-width="50" stroke-dasharray="<?php echo $stroke_length; ?> 150" class="pie"/>
  </svg>
</figure>