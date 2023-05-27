
class Votes {

    constructor(opt) {
        this.votes = [];
        this.my_votes = [];
        this.voter_id = null;
        this.handler = opt;
        this.fetchVotes();
    }

    fetchVotes() {
        var obj = this;
        $.ajax({
            type: 'get',
            url: 'custom/Controllers/VotesController.php?action=fetch',
            dataType: 'json',
            success: function(response){
                obj.votes = response;
                obj.handler(obj);
            }
        });
    }

    fetchByVotersId(opt) {
        var obj = this;
        $.ajax({
            type: 'get',
            url: 'custom/Controllers/VotesController.php?action=fetchByVotersId&voters_id='+opt.voters_id,
            dataType: 'json',
            success: function(response){
                obj.my_votes = response;
                opt.success(response, obj);
            }
        });
    }

    setVote(data, handler) {
        this.voter_id = data.voter_id
        this.votes = data;

        let formData = {};
        // formData.append('voter_id', data.voter_id);
        data.data.map((element, i) => {
            let tmp = {};
            console.log('Before', element);
            tmp['voter_id'] = data.voter_id.voter;
            tmp['position_id'] = element.position.id;
            tmp['candidate_id'] = element.candidate_id;
            console.log('El '+i, tmp);
            formData[i] = tmp;
        });
        console.log('Form',formData);
        $.ajax({
            type: 'POST',
            url: 'custom/Controllers/VotesController.php?action=setVote',
            contentType: "application/json; charset=utf-8",
            dataType:'json',
            data: JSON.stringify({data:formData}),
            success: function(response){
               handler(response);
            }
        });
        console.log('Voted', data);
    }

    getVoteByCandidate(candidates ,candid_id) {
        console.log('Vote Votes', candidates);
        return candidates.filter(elem => elem.candidate_id == candid_id);
    }
}