function gdp(params) {
    // 基于准备好的dom，初始化echarts实例
    let myChart = echarts.init(document.getElementById('world_population'));
    let colorGroup = '#36a9e1';
    // 指定图表的配置项和数据
    let option = {
        title: {
            top:'4%',
            left:'7%',
            show:true,
            text: 'Gross Domestic Product',
            textStyle:{
                textAlign:'left',
                fontSize:12,
            }
        },

        tooltip:{
            trigger:'axis',
            axisPointer:{
                type:'cross',
            },
            formatter:function(params){
                let br = '<br>';
                let result = '';
                let lastIndex = params.length-1;
                for(let i=0,len = params.length; i<len; i++){
                    if(i === 0){
                        result += params[i].name+br+params[i].marker+params[i].seriesName+':'+params[i].value+br;
                        continue;
                    }
                    if(i === lastIndex){
                        result += params[i].marker+params[i].seriesName+':'+params[i].value+'<span>';
                        continue;
                    }
                    if(params[i].name === params[i-1].name){
                        result += params[i].marker+params[i].seriesName+':'+params[i].value+br;
                    }else{
                        result += '<span style="color:'+colorGroup+'">'+br+params[i].name+br+params[i].marker+params[i].seriesName+':'+params[i].value+br;
                    }
                }
                return result;
            }
        },
        legend: {
            data:params.country
        },
        grid: {
            left:'10%',
            width:'80%',
        },
        xAxis: [
            {
                type:'category',
                data: params.years,
                inverse:true,
                axisLable:{
                    show:false
                },
                axisLable:{
                    color:'#fff',
                },
            },
            {
                type:'category',
                data: params.years,
                axisLable:{
                    show:false
                },
                axisLabel: {
                    color:colorGroup,
                }
            },
        ],
        yAxis: [
            {
                name: 'Total',
                nameGap: 7,
                nameLocation:'start',
                nameTextStyle:{
                    padding:[0,50,0,0],
                },
                boundaryGap: [0, '1%'],
                inverse:true,
                axisLabel: {
                    margin: 8,
                    fontStyle: 'italic',
                    fontFamily: 'Arial',
                    formatter: '${value} 亿'
                }
            },
            {
                name: 'Capita',
                nameGap: 7,
                nameLocation:'start',
                nameTextStyle:{
                    padding:[0,0,0,70],
                    fontFamily: 'Arial',
                    color:colorGroup,
                },
                boundaryGap: [0, '1%'],
                axisLabel: {
                    margin: 8,
                    fontStyle: 'italic',
                    fontFamily: 'Arial',
                    color:colorGroup,
                    formatter: '${value}万'
                },
            },
        ],
        series:[
            {
                name:params.count[0].country,
                type:'bar',
                data:params.count[0].count
            },
            {
                name:params.count[1].country,
                type:'bar',
                data:params.count[1].count
            },
            {
                yAxisIndex:1,
                xAxisIndex:1,
                name:params.count[0].country,
                type:'bar',
                data:params.count[0].population,
            },
            {
                name:params.count[1].country,
                yAxisIndex:1,
                xAxisIndex:1,
                type:'bar',
                data:params.count[1].population
            },
        ],
        backgroundColor:'rgba(54, 169, 225, 0.1)',
    };
    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);

}

function population (params){
    let mydata = params;

    let optionMap = {
        backgroundColor: 'transparent',
        title: {
            left:'32%',
            textStyle:{
                color:'#ffffff',
            },
            text: 'population',
        },
        tooltip : {
            trigger: 'item',
            formatter:'{b}<br/>{c}万',
            type:'continuous ',
            right:'1%',

        },

        geo:{
            left:'right'
        },
        //左侧小导航图标
        visualMap: {
            min: 0,
            max: 12000,
            text:['High','Low'],
            realtime: true,
            calculable: true,
            inRange: {
                color: ['lightskyblue','yellow', 'orangered'],
            },
            x:'6%',
            y:'center',
            /*show : true,
            splitList: [
                {start: 10000},{start: 8000, end: 10000},
                {start: 6000, end: 8000},{start: 4000, end: 6000},
                {start: 2000, end: 4000},{start: 0, end: 2000},
            ],
            color: ['#5475f5', '#9feaa5', '#85daef','#74e2ca', '#BB6690', '#0bc8d4']*/
        },

        //配置属性
        series: [{
            name: '数据',
            type: 'map',
            mapType: 'china',
            roam: false,
            left:'27%',
            top:'12%',
            mapLocation:{
                height:210,
            },
            label: {
                normal: {
                    show: false//省份名称
                },
            },
            data:mydata  //数据
        }]
    };
    let myChart = echarts.init(document.getElementById('container'));

    let geoCoordMap = {

    };

    let convertData = function (data) {
        let res = [];
        for (let i=0,l=data.length; i<l; i++) {
            let geoCoord = geoCoordMap[data[i].name];
            if (geoCoord) {
                res.push({
                    name: data[i].name,
                    value: geoCoord.concat(data[i].value)
                });
            }
        }
        return res;
    };

    let option = {
        backgroundColor: 'transparent',
        title: {
            left:'48%',
            textStyle:{
                color:'#ffffff',
            },
            text: '各省人口',
        },
        tooltip : {
            trigger: 'item',
            formatter:'{b}<br/>{c}万',
            type:'continuous ',
            right:'1%',

        },

        visualMap: {
            min: 0,
            max: 12000,
            x:'6%',
            y:'center',
            text:['high','low'],
            calculable : true,
            textStyle: {
                color:'#fff'
            }
        },
        series : [
            {
                name: 'population',
                type: 'map',
                mapType: 'china',
                left:'27%',
                top:'12%',
                roam: true,
                scaleLimit: {
                    min:1,
                    max:50
                },
                label: {
                    normal: {
                        show: false
                    },
                    emphasis: {
                        show: true
                    }
                },
                data:mydata
            },

        ]
    };
    //myChart.setOption(optionMap);
    myChart.setOption(option);

    let ratio = Array();
    let maxValue = 0;
    for(let i=0; i<10; i++){
        if(mydata[i]['value'] > maxValue){
            maxValue = mydata[i]['value'];
        }
    }
    for(let i=0; i<10; i++){
        if(mydata[i]['value'] === maxValue){
            ratio[i] = '100%';
            continue;
        }
        ratio[i] = Math.round(Number(String(mydata[i]['value']/maxValue*100).substr(0,3)))+'%';
    }
    $(".singleBar").each(function() {
        let i = $(this).index();
        $(this).find(".value").animate({
                height: ratio[i],
            },
            1000
        );
        $(this).find(".title").html(mydata[i]['simple']);
        $(this).attr('title',String(mydata[i]['name']+': '+mydata[i]['value'])+'万');
    });
};

function area(params) {
    let option = {
        tooltip: {
            trigger: 'item',
            formatter: "{a} <br/>{b}: {c} ({d}%)"
        },
        legend: {
            orient: 'vertical',
            x: 24,
            y: 16,
            data:params.countryList
        },
        series: [
            {
                name:'Land',
                type:'pie',
                radius: ['50%', '70%'],
                avoidLabelOverlap: false,
                center:['68%','43%'],
                label: {
                    normal: {
                        show: false,
                        position: 'center'
                    },
                    emphasis: {
                        show: true,
                        textStyle: {
                            fontSize: '30',
                            fontWeight: 'bold'
                        }
                    }
                },
                labelLine: {
                    normal: {
                        show: false
                    }
                },
                data:params.areaList,
            }
        ]
    };
    let charts = echarts.init(document.getElementById('area'));
    charts.setOption(option);
}

function industry(params){
    let myChart = echarts.init(document.getElementsByClassName('chart-type1')[0]);
    let option = {
        grid: {
            top:25,
            right:'12%',
            bottom:20,
        },
        title: {
            left:'7%',
            show:true,
            text: '中国工业增加值增长(%)',
            textStyle:{
                textAlign:'left',
                fontSize:12,
            }
        },
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'cross',
            },
        },
        toolbox: {
            show: true,
            orient:'vertical',
            top:'6%',
            right:'3%',
            feature: {
                dataZoom: {
                    yAxisIndex: 'none'
                },
                dataView: {readOnly: false},
                restore: {},
                saveAsImage: {}
            }
        },
        xAxis: {
            type: 'category',
            boundaryGap: false,
            data: params.date
        },
        yAxis: {
            type: 'value'
        },
        series: [{
            data: params.value,
            type: 'line',
            areaStyle: {}
        }]
    };
    myChart.setOption(option);
}

$(document).ready(function(){
    let prefix = '/interface/';
    $.getJSON(prefix+'countcp',function(params){
        gdp(params);
    });
    $.getJSON(prefix+'pochi',function(params){
        population(params);
    });
    $.getJSON(prefix+'tarea',function(params){
        area(params);
    });
    $.getJSON(prefix+'industry',function(params){
        industry(params);
    });
});
