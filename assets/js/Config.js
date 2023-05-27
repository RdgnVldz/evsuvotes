
class Config {

    constructor(opt) {
        this.config = [];
        this.handler = opt;
        this.fetchConfig();
    }

    fetchConfig() {
        var obj = this;
        $.ajax({
            type: 'get',
            url: 'custom/config.php',
            dataType: 'json',
            success: function(response) {
                obj.config = response;
                obj.handler(response);
            }
        });
    }
}