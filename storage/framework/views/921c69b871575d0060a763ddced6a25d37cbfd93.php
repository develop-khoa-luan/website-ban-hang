<?php $__env->startSection('admin_content'); ?>

<title>Apriori Algorithm Demo</title>
<script type="text/javascript" src="<?php echo e(asset('public/backend/apriori-js/jquery/jquery-1.7.2.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/backend/apriori-js/Itemset.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/backend/apriori-js/ItemsetCollection.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/backend/apriori-js/AssociationRule.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/backend/apriori-js/Bit.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/backend/apriori-js/AprioriMining.js')); ?>"></script>


<div class="row">
    <div class="col-9 d-flex justify-content-center">
        <div class="row">
            <div class="col-12">
                <div class="col-sm-10 offset-sm-1">
                    <h3 class="text-dark text-center">Apriori Algorithm <span id="counter"></span></h3>
                </div>
            </div>
            <div class="col-12">
                <table id="AprioriTable" class="col-12 table table-hover table-dark">
                    <tr>
                        <td colspan="2">
                            <textarea id="DBTextBox" rows="7" class="form-control" readonly="readonly"></textarea>
                        <td><button id="ResetDBButton" hidden>Reset DB</button></td>
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
                    <tr style="height: 10px;">
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <textarea id="ResultTextBox" rows="7" class="form-control" readonly="readonly"></textarea>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-3"></div>
</div>
<script>
// Apriori.js

console.log(<?php echo json_encode($itemsets); ?>);

// var _testDB = [
//     '1, 2, 3, 4, 5',
//     '1, 3',
//     '1, 3, 2',
//     '3, 4, 5',
//     '4, 2, 1'
// ];

var _testDB = <?php echo json_encode($itemsets); ?>;

var _db = [];

$(function() {
    SetControlBehaviors();
    $('#ResetDBButton').click();
    $('#ItemsTextBox').focus();
});

///////////////////
// Helper Methods

function SetControlBehaviors() {
    // Set generate-db-button behavior
    $('#GenerateDBButton').click(function() {
        // Read comma-separated items with whitespace removed
        let items = $.trim($('#ItemsTextBox').val());
        let itemsList = items.split(',');
        for (var i in itemsList) {
            itemsList[i] = $.trim(itemsList[i]);
        }

        // Generate random database
        let transCount = parseInt($.trim($('#TransCountTextBox').val()));

        _db = [];
        for (var transIndex = 0; transIndex < transCount;) {
            let itemCount = getRandomInt(1, itemsList.length);
            let itemset = [];

            for (var j = 0; j < itemCount; j += 1) {
                let itemIndex = getRandomInt(1, itemsList.length);
                let item = itemsList[itemIndex - 1];
                if (itemset.indexOf(item) < 0)
                    itemset.push(item);
            }

            if (itemset.length > 0) {
                _db.push(itemset.join(', '));
                transIndex += 1;
            }
        }

        $('#DBTextBox').val(_db.join('\n'));
    });

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

        // Step1: Find large itemsets for given support threshold
        let supportThreshold = parseFloat($.trim($('#SupportThresholdTextBox').val()));
        let L = AprioriMining.doApriori(db, supportThreshold);
        ClearResult();
        AddResultLine(L.length + ' Large Itemsets (by Apriori):');
        AddResultLine(L.join('\n'));
        AddResultLine('');

        // Step2: Build rules based on large itemsets and confidence threshold
        let confidenceThreshold = parseFloat($.trim($('#ConfidenceThresholdTextBox').val()));
        let allRules = AprioriMining.mine(db, L, confidenceThreshold);
        AddResultLine(allRules.length + " Association Rules");
        AddResultLine(allRules.join('\n'));
    });
}

function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

function AddResultLine(text) {
    $('#ResultTextBox').val($('#ResultTextBox').val() + text + '\n');
}

function ClearResult(text) {
    $('#ResultTextBox').val('');
}

function testObjects() {
    var is = new ItemsetCollection();
    is.push(Itemset.from(['ab', 'bc', 'c']));
    is.push(Itemset.from(['a', 'e', 'f']));
    is.push(Itemset.from(['d', 'n']));
    //alert(is.getUniqueItems());
    //alert('Support:' + is.findSupport(Itemset.from(['d','n'])));

    var i = Itemset.from(['a', 'b']);
    i.Support = 40;
    //alert(i);
    //alert(i.includesItemset(Itemset.from(['b','a'])));
    //alert('Removed:' + i.removeItemset(Itemset.from(['a'])));

    var rule1 = new AssociationRule();
    rule1.X = Itemset.from(['a', 'b']);
    rule1.Y = Itemset.from(['c']);
    rule1.Support = 45.857;
    rule1.Confidence = 80;
    //alert(rule1);

    //alert(Bit.decimalToBinary(16, 6));
    //alert(Bit.decimalToBinary(15, 6));

    //alert(Bit.getOnCount(16, 6));
    //alert(Bit.getOnCount(15, 6));

    //alert(Bit.findSubsets(Itemset.from(['a','b','c','d']), 0));
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\website-online\resources\views/admin/apriori.blade.php ENDPATH**/ ?>