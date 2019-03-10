$('#mpanel').slideVerify({
    //滑动验证码type=1，拼图验证码type=2
    type : 1,
    //......更多参数设置请查阅文档

    //验证成功以后的回调
    success : function() {
        alert('验证匹配！');
    }

});
