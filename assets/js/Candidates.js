
class Candidates {

    constructor(opt) {
        this.candidates = [];
        this.handler = opt;
        this.positions = [];
        this.current_position = {};
        this.selectedCandidates = [];
        this.fetchCandidates();
    }

    fetchCandidates() {
        var obj = this;
        $.ajax({
            type: 'get',
            url: 'custom/Controllers/CandidatesController.php?action=fetch',
            dataType: 'json',
            success: function(response){
                let tmp = response;
                let cur = [...tmp];
                let uniq = new Set();
                let positions = [];
                obj.candidates = response.slice(0);
                response.filter((item, i) => {
                    let getPosition = tmp.filter(elem => elem.position_id == item.position_id);
                    let candids = cur.filter(elem => elem.position_id == item.position_id);
                    item.candidates = candids;
                    uniq.add(item); 
                    if (getPosition.length > 1) {
                        delete tmp[i];
                        uniq.delete(item);
                    }
                });

                positions = [... new Set(uniq)];
                obj.positions = positions.slice(0);
                
                obj.handler(positions, obj);
            }
        });
    }

    selCandidate = (data, handler) => {
        // console.log('Selected Candidate: '+data.candidate_id,this.selectedCandidates);
        if (this.selectedCandidates.length > 0) {
            if (!this.selectedCandidates.find(elem => elem.position.position_id == data.position.position_id)) {
                this.selectedCandidates.push(data);
            }
            else {
                let votes = this.selectedCandidates.filter(elem => elem.position.position_id == data.position.position_id).length;
                if (!this.selectedCandidates.find(elem => elem.candidate_id == data.candidate_id)) {
                    if (votes < data.position.max_vote) {
                        this.selectedCandidates.push(data);
                    }
                    else {
                        handler('Max Votes reach', 'max');
                        console.log('Max Votes reach');
                    }
                }
                else {
                    handler('You Already voted this candidate', 'voted');
                    console.log('You Already voted this candidate');
                }
            }
        }
        else {
            this.selectedCandidates.push(data);
        }
        console.log('Votes: ',this.selectedCandidates);
        return [];
    };

    removerVote(data) {
        let tmp = [];
        this.selectedCandidates.map(elem => {
            if ((data.position_id == elem.position.position_id)==false) {
                tmp.push(elem);
            }
        });
        this.selectedCandidates = tmp;
        console.log('New Updates', this.selectedCandidates);
    }

    removeVoteCandidId(data) {
        let tmp = [];
        this.selectedCandidates.map(elem => {
            if ((data.candidate_id == elem.candidate_id)==false) {
                tmp.push(elem);
            }
        });
        this.selectedCandidates = tmp;
        console.log('New Updates', this.selectedCandidates);
    }

    getCandidate(candid_id) {
        return this.candidates.find(elem => elem.candidates_id == candid_id);
    }
}