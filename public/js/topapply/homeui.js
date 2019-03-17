

$(function(){
    $.getJSON("/countcp", function (params) {
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('world_population'));
        var colorGroup = '#36a9e1';
        // 指定图表的配置项和数据
        var option = {
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
                    var br = '<br>';
                    var result = '';
                    var len = params.length;
                    var lastIndex = len-1;
                    for(var i=0; i<len; i++){
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
                left:'8%',
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
                        formatter: '{value} 亿'
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
    });
});


$(document).ready(function(){
    $.get('/pochi',function (params){
        var mydata = params;

        var optionMap = {
            backgroundColor: 'transparent',
            title: {
                left:'center',
                textStyle:{
                    color:'#ffffff',
                },
                text: '2018 china population',
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
                x:-5,
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
                roam: true,
                left:'10%',
                mapLocation:{
                    height:300,
                },
                label: {
                    normal: {
                        show: false//省份名称
                    },
                },
                data:mydata  //数据
            }]
        };

        var myChart = echarts.init(document.getElementById('container'));
        myChart.setOption(optionMap);
    },'json');
});


$(function () {

    $.getJSON('/tarea',function (params) {
      var option = {
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
    };  var charts = echarts.init(document.getElementById('area'));
        charts.setOption(option);
    })
})

