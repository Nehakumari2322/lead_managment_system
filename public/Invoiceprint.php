<!DOCTYPE html>
<html lang="en">
<head>
  <title>Invoice</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
	<style type="text/css">
		@media print {
          body {

            font-size: 10.6pt;
          }
		@page { size: landscape;  margin: 0mm; }
/*		@media print{@page {size: landscape}}*/

</style>
	<script  type="text/javascript">
    function onlyNumbers(evt) {
		    var e = event || evt; // For trans-browser compatibility
		    var charCode = e.which || e.keyCode;

		    if (charCode > 31 && (charCode < 48 || charCode > 57))
		        return false;
		    return true;
		}

		function NumToWord(inputNumber, outputControl) {
		    var str = new String(inputNumber)
		    var splt = str.split("");
		    var rev = splt.reverse();
		    var once = ['Zero', ' One', ' Two', ' Three', ' Four', ' Five', ' Six', ' Seven', ' Eight', ' Nine'];
		    var twos = ['Ten', ' Eleven', ' Twelve', ' Thirteen', ' Fourteen', ' Fifteen', ' Sixteen', ' Seventeen', ' Eighteen', ' Nineteen'];
		    var tens = ['', 'Ten', ' Twenty', ' Thirty', ' Forty', ' Fifty', ' Sixty', ' Seventy', ' Eighty', ' Ninety'];
		    numLength = rev.length;
		    var word = new Array();
		    var j = 0;

		    for (i = 0; i < numLength; i++) {
		        switch (i) {

		            case 0:
		                if ((rev[i] == 0) || (rev[i + 1] == 1)) {
		                    word[j] = '';
		                }
		                else {
		                    word[j] = '' + once[rev[i]];
		                }
		                word[j] = word[j];
		                break;

		            case 1:
		                aboveTens();
		                break;

		            case 2:
		                if (rev[i] == 0) {
		                    word[j] = '';
		                }
		                else if ((rev[i - 1] == 0) || (rev[i - 2] == 0)) {
		                    word[j] = once[rev[i]] + " Hundred ";
		                }
		                else {
		                    word[j] = once[rev[i]] + " Hundred "; //removed and Hundred and 
		                }
		                break;

		            case 3:
		                if (rev[i] == 0 || rev[i + 1] == 1) {
		                    word[j] = '';
		                }
		                else {
		                    word[j] = once[rev[i]];
		                }
		                if ((rev[i + 1] != 0) || (rev[i] > 0)) {
		                    word[j] = word[j] + " Thousand";
		                }
		                break;

		                
		            case 4:
		                aboveTens();
		                break;

		            case 5:
		                if ((rev[i] == 0) || (rev[i + 1] == 1)) {
		                    word[j] = '';
		                }
		                else {
		                    word[j] = once[rev[i]];
		                }
		                if (rev[i + 1] !== '0' || rev[i] > '0') {
		                    word[j] = word[j] + " Lakh";
		                }
		                 
		                break;

		            case 6:
		                aboveTens();
		                break;

		            case 7:
		                if ((rev[i] == 0) || (rev[i + 1] == 1)) {
		                    word[j] = '';
		                }
		                else {
		                    word[j] = once[rev[i]];
		                }
		                if (rev[i + 1] !== '0' || rev[i] > '0') {
		                    word[j] = word[j] + " Crore";
		                }                
		                break;

		            case 8:
		                aboveTens();
		                break;

		            //            This is optional. 

		            //            case 9:
		            //                if ((rev[i] == 0) || (rev[i + 1] == 1)) {
		            //                    word[j] = '';
		            //                }
		            //                else {
		            //                    word[j] = once[rev[i]];
		            //                }
		            //                if (rev[i + 1] !== '0' || rev[i] > '0') {
		            //                    word[j] = word[j] + " Arab";
		            //                }
		            //                break;

		            //            case 10:
		            //                aboveTens();
		            //                break;

		            default: break;
		        }
		        j++;
		    }

		    function aboveTens() {
		        if (rev[i] == 0) { word[j] = ''; }
		        else if (rev[i] == 1) { word[j] = twos[rev[i - 1]]; }
		        else { word[j] = tens[rev[i]]; }
		    }

		    word.reverse();
		    var finalOutput = '';
		    for (i = 0; i < numLength; i++) {
		        finalOutput = finalOutput + word[i];
		    }
		    document.getElementById(outputControl).innerHTML = finalOutput;
		}
  </script>

<div class="container-fluid">
	<br>
	<br>
	<div class="card small mb-0 mt-0 border-0">
		<div class="row ">
			<div class="col-md-5">
				<div class="card h-100 border-0 ">
					<p class="ms-2">
					<img src="<?php echo URLROOT.'/img/logo.png';?>" class="card-img-top"style="height:100px; width: 100px;">
					<span class="text-info h5">Marriyan Health Science Pvt. Ltd.</span>
				</p>

				</div>
			</div>
			<div class="col-md-7">
				<div class="card h-100 border-0">
					<div class="row">
						<div class="col-md-6">
							<div class="card h-100 border-0">
								<h5 class="text-danger">INVOICE</h5>
								
								<p><b>Invoice Id: </b><?php echo $additionalData[0]->sales_order_id; ?>
									<br>
								<b>Invoice Date:</b><?php echo $additionalData[0]->order_ts; ?></p>
							</div>
						</div>
						<div class="col-md-6">
							<div class="row">
							<div class="col-md-6">
								<div class="card h-100 border-0 small">
									<b><u>Issued By:</u></b>

									Marriyan Health Science <br>
									sfasfasfasf <br>
									Uttarakhand <br>
									Pincode: 123456<br>
								</div>
							</div>
							<div class="col-md-6">
								<div class="card h-100 border-0 small">
									<b><u>Issued To:</u></b>

									<?php echo $additionalData[0]->name; ?> <br>
									<?php echo $additionalData[0]->address_line1; ?> <br>
									<?php echo $additionalData[0]->address_line2; ?> <br>
									<?php echo $additionalData[0]->state." , ".$additionalData[0]->city; ?> <br>
									Pincode: <?php echo $additionalData[0]->pincode?>
								</div>
							</div>
						</div>
						</div>
					</div>
					<hr>
				</div>
			</div>
		</div>
<!-- 		<div class="row">
			<div class="col-md-5">
				<div class="card h-100 border-0">
					 Logo 
				</div>
			</div>
			<div class="col-md-7">
				<div class="card h-100 border-0">
					<div class="row">
						<div class="col-md-6">
							<div class="card h-100 border-0">
							</div>
						</div>
						<div class="col-md-6">
								<div class="card h-100 border-0">
									<b>Issued To:</b>

									Marriyan Health Science <br>
									sfasfasfasf <br>
									Uttarakhand <br>
									Pincode: 123456
								</div>
						</div>
					</div>
				</div>
			</div>
		</div> -->
		<div class="card  border-0 m-0 p-0">
			<div class="card-body">
        <div class="table-responsive">
          <table class="table table-sm small m-0 m-0">
              <thead>
                <tr class="bg-secondary text-white">
                  <th scope="col">SN</th>
                  <th scope="col">Goods Description</th>
                  <th scope="col">HSN/SAC</th>
                  <th scope="col">Quantity</th>
                  <th scope="col">Rate</th>
                  <th scope="col">Taxable Amount</th>
                  <?php if($additionalData[0]->tax_choice == 'CSGST'){ ?>
		                <th scope="col">Tax - CGST</th>
		                <th scope="col">Tax</th>
		                <th scope="col">Tax - SGST</th>
		                <th scope="col">Tax</th>
                  <?php } else {?>
                  	<th scope="col">Tax - IGST</th>
		                <th scope="col">Tax</th>
                  <?php };?>
                    <th scope="col">Total</th>
                </tr>
              </thead>
              <tbody>
              	<?php $count = 0; $cgstAmount = 0; $sgstAmount = 0; $igstAmount = 0; $totalTaxableAmt = 0; $totalAmt = 0; 
              				$totalTax = 0; $totalCGST = 0; $totalSGST = 0; $totalIGST = 0;
              				foreach($data as $datarow): 
              					$cgstAmount = 0; $sgstAmount = 0; $igstAmount = 0; $taxableAmount = 0; $lineAmount = 0; $tax = 0;
              					$taxableAmount = $datarow->qty * $datarow->sale_price; 
              					$totalTaxableAmt+= $taxableAmount; 
              					$cgstAmount = $taxableAmount * $datarow->cgst_percantage * 0.01;
              					$sgstAmount = $taxableAmount * $datarow->sgst_percantage * 0.01;
              					$igstAmount = $taxableAmount * $datarow->igst_percantage * 0.01;
              	?>
              					
              	<tr>
                    <th scope="row"><?php echo $datarow->order_line_id;?></th>
                    <td><?php echo $datarow->item_desc;?><br><i>Batch: </i><?php echo $datarow->batch_number;?><br><i>Mfg Dt: </i><?php echo $datarow->mfg_date;?><br><i>Expiry: </i><?php echo $datarow->expiry_date;?></td>
                    <td><?php echo $datarow->item_nbr;?></td>
                    <td><?php echo $datarow->qty;?></td>
                    <td><?php echo $datarow->sale_price;?></td>
                    <td><?php echo $taxableAmount;?></td>
                    <?php if($additionalData[0]->tax_choice == 'CSGST'){ ?>
                    	<td><?php echo $datarow->cgst_percantage.'%';?></td>
			                <td><?php echo number_format((float)$cgstAmount,2,'.','');?></td>
			                <td><?php echo $datarow->sgst_percantage.'%';?></td>
			                <td><?php echo number_format((float)$sgstAmount,2,'.','');?></td>
                  	<?php $tax = $cgstAmount + $sgstAmount; 
                  			$lineAmount = $taxableAmount + $tax; 
                  			$totalCGST+= $cgstAmount;
                  			$totalSGST+= $sgstAmount;
                  		} else { 
                  	?>
                  		<td><?php echo $datarow->igst_percantage.'%';?></td>
                  		<td><?php echo number_format((float)$igstAmount,2,'.','');?></td>
                  	<?php $lineAmount = $taxableAmount + $igstAmount; 
                  			$tax = $$igstAmount;
                  			$totalIGST+= $igstAmount;
                  		} 
                  		$totalAmt+= $lineAmount; 
                  		$totalTax+=$tax;
                  	?>
                    <td><?php echo number_format((float)$lineAmount,2,'.','');?></td>
                </tr>
            <?php $count++; endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
		</div>
		<div class="card mb-0 mt-0 border-0">
			<div class="card-body mb-0 mt-0 pb-0 pt-0">
				<div class="row mb-0 mt-0">		
					<div class="col-md-5 small">
						<b>Bank Account Details:</b>
						<br>
						Name - Marriyan Health Services
						<br>
						Number - 12345678901234
						<br>
						IFSC Code - HDFC0001
						<br>
						Bank Name - HDFC Ranchi
						<div class="col-md-10 small">
						<div class="card fw-bold">
							Authorised Signatory
							<br><br><br>
						</div>
					</div>
					</div>
					<div class="col-md-7">
						<div class="row">
							<div class="col-md-6 fw-bold">
									Taxable 
							</div>
							<div class="col-md-6 fw-bold">
									<?php echo number_format((float)$totalTaxableAmt,2,'.',''); ?>
							</div>
						</div>
						<div class="row">
							<?php if($additionalData[0]->tax_choice == 'CSGST'){ ?>
								<div class="col-md-6 fw-bold">
									CGST
								</div>
								<div class="col-md-6 fw-bold">
									<?php echo number_format((float)$totalTax,2,'.',''); ?>
								</div>
								<div class="col-md-6 fw-bold">
									SGST
								</div>
								<div class="col-md-6 fw-bold">
									<?php echo number_format((float)$totalTax,2,'.',''); ?>
								</div>
							<?php } else { ?>
								<div class="col-md-6 fw-bold">
									IGST
								</div>
								<div class="col-md-6 fw-bold">
									<?php echo number_format((float)$totalIGST,2,'.',''); ?>
								</div>
							<?php } ?>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-6 fw-bold">
									Total
							</div>
							<div class="col-md-6 fw-bold">
									<?php echo number_format((float)$totalAmt,2,'.','');?>
							</div>
						</div>
						<?php $totalAmtSplit = explode('.',number_format((float)$totalAmt,2,'.','')); 
							$leftValue=$totalAmtSplit[0];
							$decimalValue=$totalAmtSplit[1];
						?>
						<span class="small fst-italic" >( Rupees </span>
						<span class="small fst-italic" id="totalword1"></span>
						<?php if($decimalValue >0) { ?>
								<span class="small fst-italic" >and </span>
							 	<span class="small fst-italic" id="totalword2"></span>
							 	<span class="small fst-italic" >paisa </span>
						  <?php } ?>
						<span class="small fst-italic" >Only )</span>
						
						<script type="text/javascript">
							NumToWord(<?php echo $leftValue;?>,'totalword1');
							<?php if($decimalValue >0) { ?>
							 NumToWord(<?php echo $decimalValue;?>,'totalword2');
						  <?php } ?>
						</script>
					</div>
				</div>
			</div>
		</div>
	</div>
		<!-- <div class="text-center">
			<button onclick="window.print();"></button>
		</div> -->
</div>
</body>
</html>

