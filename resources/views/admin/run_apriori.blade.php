@extends('admin_layout')
@section('admin_content')

<title>Apriori Algorithm Demo</title>
<meta name="_token" content="{{csrf_token()}}" />
<script type="text/javascript" src="{{asset('public/backend/apriori-js/jquery/jquery-1.7.2.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/backend/apriori-js/Itemset.js')}}"></script>
<script type="text/javascript" src="{{asset('public/backend/apriori-js/ItemsetCollection.js')}}"></script>
<script type="text/javascript" src="{{asset('public/backend/apriori-js/AssociationRule.js')}}"></script>
<script type="text/javascript" src="{{asset('public/backend/apriori-js/Bit.js')}}"></script>
<script type="text/javascript" src="{{asset('public/backend/apriori-js/AprioriMining.js')}}"></script>
{{-- <script type="text/javascript" src="{{asset('public/backend/apriori-js/Apriori.js')}}"></script> --}}

<div class="row">
    <div class="col-9">
        <div class="row">
            <div class="col-12">
                <div class="col-sm-10 offset-sm-1">
                    <h3 class="text-dark text-center">Apriori Algorithm <span id="counter"></span></h3>
                </div>
            </div>
            <div class="col-12">
                <table id="AprioriTable" class="col-12 table table-hover table-dark">
                    <tr hidden>
                        <td colspan="2">
                            <textarea id="DBTextBox" rows="7" class="form-control" readonly="readonly"></textarea>
                        <td><button id="ResetDBButton" hidden>Reset DB</button></td>
                        </td>
                    </tr>
                    <tr style="height: 10px;" hidden>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <textarea id="ResultTextBox" rows="7" class="form-control" readonly="readonly"></textarea>
                        </td>
                    </tr>
                    <tr style="height: 10px;">
                    </tr>
                    <tr>
                        <td colspan="2">
                            Support Threshold (%):&nbsp;&nbsp;
                            <input type="number" id="SupportThresholdTextBox" value="40.00" style="width: 80px;" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            Confidence Threshold (%):&nbsp;&nbsp;
                            <input type="number" id="ConfidenceThresholdTextBox" value="70.00"
                                style="width: 80px;" />&nbsp;&nbsp;
                            <button id="AprioriButton" style="width: 100px;">Apriori</button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card mt-5 border border-primary">
            <div class="card-header p-2 text-primary border-botton border-primary">
                Hành động
            </div>
            <div class="card-body">
                <div class="col-12">
                    <button type="button" class="btn btn-success col-12 save-apriori-data" >Lưu kết quả</button>
                </div>
                <div class="col-12">
                    <a href="{{URL::to('/apriori')}}"><input type="button" class="btn btn-primary col-12 mt-2"
                            value="Xem kết quả" /></a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$('.save-apriori-data').hide();
    // Apriori.js

console.log('This is the data: ');
console.log({!! json_encode($itemsets) !!});

var _testDB = {!! json_encode($itemsets) !!};

$(function() {
    SetControlBehaviors();
    $('#ResetDBButton').click();
    $('#ItemsTextBox').focus();
});

///////////////////
// Helper Methods

function SetControlBehaviors() {
    // Set generate-db-button behavior
    

    // Set reset-db-button behavior
    $('#ResetDBButton').click(function() {
        _db = [];
        _testDB.forEach(i => _db.push(i));

        $('#DBTextBox').val(_db.join('\n'));
    });

    // Set apriori-button behavior
    $('#AprioriButton').click(function() {
        // Create ItemsetCollection for current db
        let db = new ItemsetCollection();
        for (var i in _db) {
            let items = _db[i].split(', ');
            db.push(Itemset.from(items));
        }

        let supportThreshold = parseFloat($.trim($('#SupportThresholdTextBox').val()));
        let L = AprioriMining.doApriori(db, supportThreshold);
        ClearResult();
        // Step1: Find large itemsets for given support threshold
        // AddResultLine(L.length + ' Large Itemsets (by Apriori):');
        // AddResultLine(L.join('\n'));
        // AddResultLine('');

        // Step2: Build rules based on large itemsets and confidence threshold
        let confidenceThreshold = parseFloat($.trim($('#ConfidenceThresholdTextBox').val()));
        let allRules = AprioriMining.mine(db, L, confidenceThreshold);
        AddResultLine(allRules.length + " Association Rules");
        AddResultLine(allRules.join('\n'));
        formatData(allRules)
        $('.save-apriori-data').show();
    });
}

function AddResultLine(text) {
    $('#ResultTextBox').val($('#ResultTextBox').val() + text + '\n');
}

function ClearResult(text) {
    $('#ResultTextBox').val('');
}

//format data to json for adding to the database.
var dataApriori = [];
var dataAprioriJson = new Object();
function formatData(allRules){
    dataAprioriJson = new Object()
    dataApriori = []
    allRules.forEach(element => {
        var product_1 = 0;
        var product_2 = 0;
        var product_3 = 0;
        var product_4 = 0;
        var recommend_1 = 0;
        var recommend_2 = 0;
        var recommend_3 = 0;
        var recommend_4 = 0;
        var conf = element.Confidence;
        var sup = element.Support;
        var countX = 0;
        // The data need asc sort for recommended
        var x_array = new Array();
        x_array = element.X.sort(function(a, b){return a-b});
        x_array.forEach(x => {
            countX = parseInt(countX) + 1;
            if (countX == 1){
                product_1 = x;
            }
            if (countX == 2){
                product_2 = x;
            }
            if (countX == 3){
                product_3 = x;
            }
            if (countX == 4){
                product_4 = x;
            }
        });
        var countY = 0
        var y_array = new Array();
        y_array = element.Y.sort(function(a, b){return a-b});
        y_array.forEach(y => {
            countY = parseInt(countY) + 1;
            if (countY == 1){
                recommend_1 = y;
            }
            if (countY == 2){
                recommend_2 = y;
            }
            if (countY == 3){
                recommend_3 = y;
            }
            if (countY == 4){
                recommend_4 = y;
            }
        });

        var stringObject = `{"product_1":`+product_1+`, "product_2":`+product_2+`, "product_3":`+product_3+`, "product_4":`+product_4+`, "recommend_1":`+recommend_1
            +`, "recommend_2":`+recommend_2+`, "recommend_3":`+recommend_3+`, "recommend_4":`+recommend_4+`, "confidence":`+conf+`, "support":`+sup+`}`;
        dataApriori.push(stringObject);
    });
    dataAprioriJson.name = "dataAprioriJson";
    dataAprioriJson.value = JSON.stringify(dataApriori);
}

$('.save-apriori-data').click(function(e){
			e.preventDefault();
			$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			}
			});
			$.ajax({
			url: "{{ url('/save-apriori') }}",
			method: 'post',
			data: {
					data_apriori: dataApriori
				},
				success: function(result){
                    alert("Lưu thành công!");
				},
				error: function(result){
					alert("Lưu thất bại!");
				}});
        });
</script>
@endsection