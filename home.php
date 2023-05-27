<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">
    	<?php include 'includes/navbar.php'; ?>
            <div class="content-wrapper">
                <div class="container">
                    <section class="content">
                        <h1 class="page-header text-center"><b id="title"></b></h1>
                        <?php include './test.php' ?>
                        <div class="box">
                            <div class="box-header">
                                <ul  class="nav nav-tabs">
                                    <li class="active">
                                        <a  href="#home" data-toggle="tab">Rankings</a>
                                    </li>
                                    <li>
                                        <a href="#vote" data-toggle="tab">Vote</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="box-body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="home">
                                        <div id="positions_charts" style="width: 100%;"></div>
                                    </div>
                                    <div class="tab-pane" id="vote">
                                        <div class="row">
                                            <div class="col-sm-10 col-sm-offset-1" id="content">
                                                <ul class="nav nav-tabs" id="position_tabs">
                                                    <!-- <li class="active"><a href="#">Home</a></li>
                                                    <li><a href="#">Menu 1</a></li>
                                                    <li><a href="#">Menu 2</a></li>
                                                    <li><a href="#">Menu 3</a></li> -->
                                                </ul>
                                                <div class="tab-content clearfix" id="tab_content">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
      	<?php include 'includes/ballot_modal.php'; ?>
    </div>
    <div class="modal" id="preview">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-body">
                    <ul class="list-group" id="preview_list">
                        
                    </ul>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-danger" id="finish_vote">Finish</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="preview_platform" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <b>Platform</b>
                            </div>
                        </div>
                        <div class="card-body" style="border:solid lightgray 1px;height:400px;padding:10px;border-radius:5px;margin-top: 20px" id="platform_banner">

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-danger">Finish</button>
                </div>
            </div>
        </div>
    </div>
</body>

<?php include 'includes/scripts.php'; ?>
<script src="./assets/js/Config.js"></script>
<script src="./assets/js/Votes.js"></script>
<script src="./assets/js/Candidates.js"></script>
<script src="https://cdn.jsdelivr.net/npm/frappe-charts@1.1.0/dist/frappe-charts.min.iife.js"></script>
<style>
    .title {
        font-size: 18px;
    }
</style>
<script>
    let finish_vote = document.getElementById('finish_vote');
    let content = document.getElementById('content');
    let tab_content = document.getElementById('tab_content');
    let position_tabs = document.getElementById('position_tabs');
    let title = document.getElementById('title');
    let divMsg = document.createElement('div');
    let divMsgClass = document.createAttribute('class');
    let divMsgH3 = document.createElement('h3');
    let divMsgA = document.createElement('a');
    let divMsgAClass = document.createAttribute('class');
    let tab_positions = [];
    let active_tab = null;
    var votes = null;
    let candidates = null;

    divMsgClass.value = 'text-center';
    divMsgAClass.value = 'btn btn-flat btn-primary btn-lg';

    divMsg.setAttributeNode(divMsgClass);
    divMsgA.setAttributeNode(divMsgAClass);
    divMsg.appendChild(divMsgH3);
    divMsg.appendChild(divMsgA);
    
    let config = new Config(function(res) {
        title.innerText = res.election_title;
        _initVotes(res);
    });

    function _initVotes(config) {
        votes = new Votes(function(res) {
            console.log('Config',config);
            let charts = document.getElementById('positions_charts');
            let Vcandidates = new Candidates(function(positions, obj) {
                
                

                res.votes.forEach(v => {
                    v['position'] = obj.candidates.find(elem => elem.candidates_id == v.candidate_id);
                    obj.selectedCandidates.push(v);
                });

                console.log('My Kind', obj);
                submitVote(obj);
                console.log('Positions', positions);
                positions.map((position, index) => {
                    let chart = document.createElement('div');
                    chart.style = 'width: auto;margin-top:10px;border: solid lightgray 1px';

                    let candidates = [];
                    let votes = [];
                    let posVote = 0;
                    position.candidates.forEach(candidate => {
                        let getVotes = res.getVoteByCandidate(res.votes, candidate.candidates_id);
                        console.log('Candids', getVotes);
                        posVote = posVote + getVotes.length;
                        votes.push(getVotes.length);
                        candidates.push(candidate.firstname+' '+candidate.lastname);
                    });
                    console.log('Position Votes', posVote);
                    charts.appendChild(chart);
                    const data = {
                        labels: candidates,
                        datasets: [{
                                name: "Votes", type: "bar",
                                values: votes
                            }
                        ],
                        yMarkers: [
                            {
                                label: "Votes",
                                value: (posVote+13),
                                options: { labelPos: 'left' } // default: 'right'
                            }
                        ],
                        yRegions: [
                            {
                                label: "Total Votes: "+posVote,
                                start: 0,
                                end: posVote,
                                options: { labelPos: 'right' }
                            }
                        ],
                    }
                    let line = new frappe.Chart(chart, {  // or a DOM element,
                        title: position.description,
                        data: data,
                        type: 'bar', // or 'bar', 'line', 'scatter', 'pie', 'percentage'
                        height: 300,
                        colors: ['#7cd6fd']
                    });
                });
                
            });
        }).fetchByVotersId({
            voters_id: config.login_id.voter,
            success: function(res, obj) {
                votes = obj;
                divMsgH3.innerText = 'You have already voted for this election.';
                divMsgA.innerText = 'View Ballot';

                divMsgA.onclick = function() {
                    finish_vote.disabled = true;
                    finish_vote.innerText = 'Finished';
                    $('#preview').modal('show');
                }
                res.length > 0?content.appendChild(divMsg):_initCandidates(res, obj);
            }
        });
    }

    function _initCandidates(res, obj) {
        candidates = new Candidates(function(res, obj) {
            console.log('Candidate', obj);
            let i = 0;
            let xyz = 0;
            res.map((position,xxx) => {
                i==0?obj.current_position=position:'';
                let tablI = document.createElement('li');
                let tabA = document.createElement('a');

                let tablIClass = document.createAttribute('class');
                let tablId = document.createAttribute('id');
                let tabADataToggle = document.createAttribute('data-toggle');
                let tabAHref = document.createAttribute('href');
                
                let Collapse = document.createElement('div');
                let CollapseCardCardBody = document.createElement('div');

                let CollapseClass = document.createAttribute('class');
                let CollapseId = document.createAttribute('id');
                let CollapseCardCardBodyClass = document.createAttribute('class');

                CollapseClass.value = i==0?'tab-pane active':'tab-pane fade';
                CollapseId.value = 'position_tab_toggle_'+position.position_id;
                CollapseCardCardBodyClass.value = 'card card-body';

                Collapse.setAttributeNode(CollapseClass);
                Collapse.setAttributeNode(CollapseId);
                CollapseCardCardBody.setAttributeNode(CollapseCardCardBodyClass);

                Collapse.appendChild(CollapseCardCardBody);

                tab_positions.push('active custom_tabs_'+position.position_id);
                
                tablId.value = 'active custom_tabs_'+position.position_id;
                active_tab = i==0?'active custom_tabs_'+position.position_id:'';
                tablIClass.value = i==0?'active custom_tabs_'+position.position_id:'';
                tabADataToggle.value = 'tab';
                tabA.id = 'custom_tabs_'+position.position_id;
                tabAHref.value = '#position_tab_toggle_'+position.position_id;
                tabA.innerText = position.description;

                tablI.onclick = function() {
                    selPos(position);
                };

                tablI.setAttributeNode(tablIClass);
                tablI.setAttributeNode(tablId);
                tabA.setAttributeNode(tabADataToggle);
                tabA.setAttributeNode(tabAHref);

                tablI.appendChild(tabA);
                position_tabs.appendChild(tablI);

                let row = document.createElement('div');
                let col = document.createElement('div');
                let box = document.createElement('div');
                let boxHead = document.createElement('div');
                let boxTitle = document.createElement('h3');
                let boxTitleB = document.createElement('b');
                let boxBody = document.createElement('div');
                let boxFoot = document.createElement('div');
                let boxFootPrev = document.createElement('button');
                let boxFootNext = document.createElement('button');
                let boxFootSubmit = document.createElement('button');

                let rowClass = document.createAttribute('class');
                let colClass = document.createAttribute('class');
                let boxClass = document.createAttribute('class');
                let boxHeadClass = document.createAttribute('class');
                let boxTitleClass = document.createAttribute('class');
                let boxBodyClass = document.createAttribute('class');

                rowClass.value = 'row';
                colClass.value = 'col-xs-12';
                boxClass.value = 'box box-solid';
                boxHeadClass.value = 'box-header with-border';
                boxTitleClass.value = 'box-title';
                boxBodyClass.value = 'box-body';
                boxFoot.className = 'box-footer';
                boxFootPrev.className = i>0?'btn btn-primary btn-sm':'btn btn-primary btn-sm disabled';
                boxFootPrev.disabled = i>0?'':'true';
                boxFootPrev.innerText = 'Prev';
                console.log('Obj', obj);
                boxFootNext.className = (i+1)<obj.positions.length?'btn btn-primary btn-sm':'btn btn-primary btn-sm disabled';
                boxFootNext.disabled = (i+1)<obj.positions.length?'':'true';
                boxFootNext.innerText = 'Next';
                boxFootSubmit.className = 'btn btn-success btn-sm';
                boxFootSubmit.innerText = 'Submit'
                boxFootNext.style = 'margin-left:5px';
                boxFootSubmit.style = 'margin-left:5px';
                boxTitleB.innerText = position.description;
                boxFootPrev.onclick = function() {
                    let prevTab = xxx>0?candidates.positions[xxx-1]:null;
                    NextPrevPosition(position, prevTab);
                }  
                boxFootNext.onclick = function() {
                    let nextTab = (xxx)<candidates.positions.length?candidates.positions[xxx+1]:null;
                    NextPrevPosition(position, nextTab);
                }  
                boxFootSubmit.onclick = function() {
                    submitVote();
                }

                row.setAttributeNode(rowClass);
                col.setAttributeNode(colClass);
                box.setAttributeNode(boxClass);
                boxHead.setAttributeNode(boxHeadClass);
                boxTitle.setAttributeNode(boxTitleClass);
                boxBody.setAttributeNode(boxBodyClass);

                boxTitle.appendChild(boxTitleB);
                boxHead.appendChild(boxTitle);
                box.appendChild(boxHead);
                box.appendChild(boxBody);
                boxFoot.appendChild(boxFootPrev);
                boxFoot.appendChild((i+1)<obj.positions.length?boxFootNext:boxFootSubmit);
                box.appendChild(boxFoot);
                col.appendChild(box);
                row.appendChild(col);

                // Body Childs
                let bodyP = document.createElement('p');
                let bodyPSpan = document.createElement('span');
                let bodyPSpanBtn = document.createElement('button');

                let bodyPSpanClass = document.createAttribute('class');
                let bodyPSpanBtnClass = document.createAttribute('class');
                let bodyPSpanBtnData = document.createAttribute('data-desc');

                bodyPSpanClass.value = 'pull-right';
                bodyPSpanBtnClass.value = 'btn btn-success btn-sm btn-flat reset';
                bodyP.innerText = 'Select only one candidate';
                bodyPSpanBtn.innerText = 'Refresh';

                bodyPSpanBtn.onclick = function() {
                    reSet();
                }

                bodyPSpan.setAttributeNode(bodyPSpanClass);
                bodyPSpanBtn.setAttributeNode(bodyPSpanBtnClass);

                bodyPSpan.appendChild(bodyPSpanBtn);
                bodyP.appendChild(bodyPSpan);
                boxBody.appendChild(bodyP);

                // Candidate List

                let candidateList = document.createElement('div');
                let ul = document.createElement('ul');

                let candidateListId = document.createAttribute('id');
                candidateListId.value = 'candidate_list';

                candidateList.setAttributeNode(candidateListId);

                candidateList.appendChild(ul);
                position.candidates.forEach(candidate => {
                    let li = document.createElement('li');
                    let liInput = document.createElement('input');
                    let liButton = document.createElement('button');
                    let liImg = document.createElement('img');
                    
                    let liInputType = document.createAttribute('type');
                    let liInputName = document.createAttribute('name');
                    let liInputId = document.createAttribute('id');
                    let liImgWidth = document.createAttribute('width');
                    let liImgHeight = document.createAttribute('height');
                    let liImgClass = document.createAttribute('class');
                    let liImgSrc = document.createAttribute('src');
                    let liInputClass = document.createAttribute('class');
                    let liInputClick = document.createAttribute('onclick');
                    let liButtonClass = document.createAttribute('class');
                    let liButtonClick = document.createAttribute('onclick');

                    liInputType.value = candidate.max_vote > 1?'checkbox':'radio';
                    liInputClass.value = 'flat-red';
                    liImgWidth.value = '100px';
                    liImgHeight.value = '100px'
                    liImgClass.value = 'clist'
                    liInputClick.value = "selCandids("+candidate.candidates_id+", this)";
                    liImgSrc.value = candidate.photo?'images/'+candidate.photo:'images/profile.jpg';
                    liInputName.value = 'radio_name_'+position.id;
                    liInputId.value = 'radio_name_'+position.id;
                    liButtonClass.value = 'btn btn-primary btn-sm btn-flat clist platform';
                    liButton.innerText = 'Platform';
                    liButtonClick.value = "viewPlatform("+candidate.candidates_id+")";

                    liInput.setAttributeNode(liInputType);
                    liInput.setAttributeNode(liInputClass);
                    liImg.setAttributeNode(liImgWidth);
                    liImg.setAttributeNode(liImgHeight);
                    liImg.setAttributeNode(liImgClass);
                    liImg.setAttributeNode(liImgSrc);
                    liInput.setAttributeNode(liInputName);
                    liInput.setAttributeNode(liInputId);
                    liInput.setAttributeNode(liInputClick);
                    liButton.setAttributeNode(liButtonClass);
                    liButton.setAttributeNode(liButtonClick);
                    
                    console.log(liInput);
                    li.appendChild(liInput);
                    li.appendChild(liButton);
                    li.appendChild(liImg);
                    li.innerHTML = li.innerHTML + '<span class="cname clist">'+candidate.firstname+' '+candidate.lastname+'</span>';
                    
                    ul.appendChild(li);
                    console.log('Input', liInput);
                });
                boxBody.appendChild(candidateList);
                //End List
                // End
                CollapseCardCardBody.appendChild(row);

                tab_content.appendChild(Collapse);
                i = i+1;
                xyz = xyz + 1;
            });
            
            console.log('Votes', obj);
        });
    }

    function selPos(position) {
        console.log('Position', position);
        candidates.current_position = position;
    }
    
    function selCandids(candid_id, elem) {
        
        if (candidates.current_position.max_vote == 1) {
            reSet(true);
        }
        let candid = candidates.selCandidate({
            position:candidates.current_position,
            candidate_id:candid_id
        },
        function(res, type) {
            if (type == 'max') {
                elem.checked = false;
                alert(res);
            }
            else {
                candidates.removeVoteCandidId({candidate_id:candid_id});
            }
            
        });
    }

    function reSet(event = null) {
        let radios = document.getElementsByName('radio_name_'+candidates.current_position.id);
        if (event == null) {
            radios.forEach(element => {
                element.checked = false;
            });
        }
       
        candidates.removerVote(candidates.current_position);
    }

    function NextPrevPosition(position, next) {
        if (next != null) {
            let curTab  = document.getElementById('custom_tabs_'+next.position_id);
            curTab.click();
            selPos(next);
        }
    }

    function submitVote(candids = null) {
        
        let ul = document.getElementById('preview_list');
        ul.innerHTML = '';
        let positions = candids==null?candidates.positions:candids.positions;
        let myVotes = candids==null?candidates.selectedCandidates:candids.selectedCandidates;

        positions.forEach(element => {
            let li = document.createElement('li');
            li.className = 'list-group-item';
            li.innerText = element.description;

            let liUl = document.createElement('ul');
            let filter = myVotes.filter(elem => elem.position.position_id == element.position_id);
            
            console.log('Votes: '+filter.length,filter);
            if (filter.length > 0) {
                filter.forEach(vote => {
                    console.log('Votes', vote);
                    let liulli = document.createElement('li');
                    liulli.className = 'list-group-item';

                    let filterCandid = vote.position.candidates.find(elem => elem.candidates_id == vote.candidate_id);
                    console.log('Filterd ', filterCandid);
                    liulli.innerText = filterCandid.firstname+' '+filterCandid.lastname;
                    liUl.appendChild(liulli);
                });
            }
            else {
                let liulli = document.createElement('li');
                liulli.className = 'list-group-item';
                liulli.innerText = 'N/A';
                liUl.appendChild(liulli);
            }

            
            li.appendChild(liUl);
            ul.appendChild(li);
        });
        
        console.log('Submit vote');
        if (candids != null) {
            finish_vote.disabled = false;
            finish_vote.innerText = 'Finish';
        }
        candids==null?$('#preview').modal('show'):'';
    }
    
    function viewPlatform(candid_id) {
        let candidate = candidates.getCandidate(candid_id);
        let platform_banner = document.getElementById('platform_banner');
        if (candidate.platform.length > 0) {
            platform_banner.innerText = candidate.platform;
        }
        else {
            platform_banner.innerText = 'Candidate have no platform yet.';
        }
        $('#preview_platform').modal('show');
    }
    
    

    finish_vote.onclick = function() {
        votes.setVote({
            voter_id: config.config.login_id,
            data:candidates.selectedCandidates
        },
        function(res){
            window.location = window.location;
            console.log('Result', res);
        });
    }
</script>