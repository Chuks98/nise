
    <div class="container-form">
      <img src="/assets/images/Form A.jpg" alt=" form " style="display: block; margin-left: auto; margin-right: auto;">
        <!--<button id="downloadBtn">Download as PDF</button>-->
      </div>

      <div class="container-form">
        <img src="/assets/images/Form b.jpg" alt=" form " style="display: block; margin-left: auto; margin-right: auto;">
          <!--<button id="downloadBtn">Download as PDF</button>-->
        </div>

    <button id="printBtn">Print</button>
<script>
    document.getElementById("printBtn").addEventListener("click", function() {
      window.print();
    });
  </script>

