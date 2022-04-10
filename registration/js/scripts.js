const payBtn = document.querySelector('.pay-btn')
let orderReviewList = document.querySelector('#order-review')
const numOfItems1 = document.querySelector('.num-of-items')
const menuItems = document.querySelectorAll('li.menu-item')
const counter = document.querySelector('#counter')
const checkOutBtn = document.querySelector('#check-out-btn')
const claimBtn = document.querySelector('#claim-btn')
const discountCode = document.querySelector('#discount-code')
const orderSummaryItems = document.querySelector('.order-summary-items')
const orderSummarySubtotal = document.querySelector('.order-summary-subtotal')
const orderSummaryTotal = document.querySelector('.order-summary-total')
const orderDiscount = document.querySelector('.order-discount')

const processData = () => {
    
    return {
        initData: function(){
            localStorage.clear()
            localStorage.setItem('items',JSON.stringify([]))
        },
        getAll: function(){
            return JSON.parse(localStorage.getItem('items'))
        },
        getOne: function(id) {
            const all = this.getAll()

            return all.filter(item => item.id.toString() === id.toString())
        },
        deleteAll: function(){
            localStorage.removeItem('items')
        },
        deleteOne: function(id) {
            const all = this.getAll()
            const newData = all.filter(item => item.id.toString() !== id.toString())
            localStorage.items = JSON.stringify(newData)
            return newData
        },
        insertOne: function(obj){
            const objId = obj.id;
            this.deleteOne(objId)
            const all = this.getAll()
            const newArr = [obj,...all]
            localStorage.items = JSON.stringify(newArr)
            return newArr
        },
        updateOne: function(id, obj){
           this.deleteOne(id)
            return this.insertOne({id,...obj})
        }
    }    
}


const init = (items)=> {
    let html = ''
let subtotal = 0
if(!items) return
let summeryContents = ''
items.forEach((item,i) => {
    html += `
    <li class="d-flex items" data-id="${item.id}" data-price="${item.price}">
        <div><img src="resources/pizza_image.jpg" alt="" width="70" ></div>
        <div class="info d-flex flex-column">
            <strong>${item.name}</strong>
            <span>Qty: <input type="number" value="${item.qty}" min="1" class="item-qty"></span>
        </div>
        <div class="d-flex flex-column action">
            <span class="btn cross">&times;</span>
            <strong class="price-strong">MYR ${item.price}</strong>
        </div>
    </li>
    
    `
    summeryContents += `${item.qty}x ${item.name}, `
    subtotal += Number(item.price)
})
subtotal = processData().getAll().reduce((cur,obj)=>{
    if(obj.cumulativeTotal) {
        cur += obj.cumulativeTotal 
    } else {
        cur += obj.price 
    }
    return cur
},0)
html +=`<li>
<strong>SUBTOTAL</strong>
<strong class="orders-subtotal">MYR ${subtotal}</strong>
</li>`
orderReviewList.innerHTML = html
numOfItems1.innerHTML = items.length

orderSummaryItems.querySelector('span').textContent = summeryContents;
orderSummaryItems.querySelector('strong').textContent = `MYR ${subtotal}`;
orderSummarySubtotal.textContent = `MYR ${subtotal}`;
let total = 0
if(JSON.parse(localStorage.getItem('order_discounted')).discounted){
    orderDiscount.innerHTML=`MYR 100`;
    total = Number(subtotal)-100;
}
orderSummaryTotal.innerHTML = `MYR ${total}`
}



const updateList = () => {
    orderReviewList = document.querySelectorAll('.items')
    
    orderReviewList.forEach((item,i) => {
        item.addEventListener('change',(e)=>{
            const numOfItems = Number(e.target.value)
            const price = Number(item.dataset.price)
            const currentItemPrice = numOfItems *price
            const priceStrong = item.querySelector('.price-strong')
            priceStrong.textContent = 'MYR '+currentItemPrice

            init(processData().updateOne(item.dataset.id,{
                name:item.querySelector('strong').innerText,  price,cumulativeTotal: currentItemPrice,qty:numOfItems,
            }))
            const subtotal = processData().getAll().reduce((cur,obj)=>{
                if(obj.cumulativeTotal) {
                    cur += obj.cumulativeTotal 
                } else {
                    cur += obj.price 
                }
                return cur
            },0)
            document.querySelector('.orders-subtotal').innerHTML = 'MYR '+subtotal
            orderSummaryItems.querySelector('strong').innerHTML = 'MYR '+subtotal
            orderSummarySubtotal.textContent = `MYR ${subtotal}`;

            let total = 0
            if(JSON.parse(localStorage.getItem('order_discounted')).discounted){
                orderDiscount.innerHTML=`MYR 100`;
                total = Number(subtotal)-100;
            }
            orderSummaryTotal.innerHTML = `MYR ${total}`
        })
        item.addEventListener('click', (e)=> {
            if(e.target.tagName ==='SPAN' && e.target.classList[1]==='cross'){
                const newData = processData().deleteOne(item.dataset.id)
                init(newData)
                item.remove()
                
            }
        })
    })
}
if (location.pathname.includes('payment.php')){
init(processData().getAll())


console.log('here')
updateList()
}
if(location.pathname.includes('cart.php') && !processData().getAll()){
    processData().initData()
} else if(location.pathname.includes('cart.php')){
}
menuItems && menuItems.forEach(item => {
    const id = Number(item.dataset.id);
    if(processData().getOne(id).length){
        item.querySelector('input[type=checkbox]').setAttribute('checked',true)
        item.querySelector('input[type=checkbox]').setAttribute('disabled',true)
    }
    counter.textContent=processData().getAll().length+' items'
    item.addEventListener('change',(e) => {
        counter.textContent=processData().getAll().length+' items'
        if(e.target.checked) {
            
            const name = item.querySelectorAll('span')[0].innerText
            const price = Number(item.querySelectorAll('span')[1].innerText)
            const qty= Number(item.querySelectorAll('span')[2].innerText)
            processData().insertOne({
                id,
                name,
                price,
                qty
            })

            counter.textContent=processData().getAll().length+' items'
            e.target.setAttribute('disabled',true);

        } else {
            counter.textContent=processData().getAll().length+' items'
        }
    })
})

checkOutBtn && checkOutBtn.addEventListener('click', async() => {
    try {
        const subtotal = processData().getAll().reduce((cur,obj)=>{
            if(obj.cumulativeTotal) {
                
                const price = obj.cumulativeTotal+ cur.price
                const quantity = obj.qty+cur.quantity
                cur =  {
                    price,
                    quantity
                }
            } else {
                const price = obj.price + cur.price
                const quantity = obj.qty+cur.quantity
                cur =  {
                    price,
                    quantity
                }
            }
            return cur
        },{
            price:0,
            quantity:0
        })

        const res = await fetch('order.php',{
            method: 'POST',
            headers: {
                'Content-Type':'application/json'
            },
            body: JSON.stringify(subtotal)
        })

        const data = await res.json()
        localStorage.setItem('order',JSON.stringify(data))
    } catch (error) {
        console.error(error)
    }
})

claimBtn && claimBtn.addEventListener('click', async()=> {
    try {
        const discount_code = discountCode.value.trim()
        const order = JSON.parse(localStorage.getItem('order'))
        if(discount_code.length) {
            const res = await fetch('reward.php',{
                method: 'POST',
                headers: {
                    'Content-Type':'application/json'
                },
                body: JSON.stringify({
                    ...order, discount_code
                })
            })
    
            const data = await res.json()
            if(data.error) {
                return
            }

            localStorage.setItem('order_discounted',JSON.stringify({
                order_ID:data.data.order_ID,
                discounted: data.data.discounted
            }))
           location.reload()
        }
    } catch (error) {
        console.error(error)
    }
})

payBtn && payBtn.addEventListener('click', async()=> {
    try {
        const paymentMethods = document.querySelectorAll('[name=payment-method]')
        let paymentMethod
        paymentMethods.forEach(item => {
            if(item.checked){
                paymentMethod = item
            }
        })
        
        const order_ID = JSON.parse(localStorage.getItem('order_discounted')).order_ID
        const amount = Number(orderSummaryTotal.innerText.replace(/\D+/,''))
        console.log(order_ID,amount)
        const res = await fetch('payment.php',{
            method: 'POST',
            headers: {
                'Content-Type':'application/json'
            },
            body: JSON.stringify({
                payment_method: paymentMethod.value,
                payment_amount: amount,
                payment_receipt:'Completed',
                order_ID
            })
        })

        // const data = await res.json()
        // console.log(data)
        alert(`You Have Completed Payment for Order ${order_ID}`)
    } catch (error) {
        console.log(error)
    }
})