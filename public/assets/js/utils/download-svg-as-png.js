function capture() {
    const captureElement = document.querySelector('#bodyPreviewQR')
    const qrItemCode = $('#previewQRCode').text()
    const qrItemName = $('#previewQRName').text()

    html2canvas(captureElement)
        .then(canvas => {
            canvas.style.display = 'none'
            document.body.appendChild(canvas)
            return canvas
        })
        .then(canvas => {
            const image = canvas.toDataURL('image/png')
            const a = document.createElement('a')
            a.setAttribute('download', 'QR '+ qrItemCode + ' ' + qrItemName +'.png')
            a.setAttribute('href', image)
            a.click()
            canvas.remove()
        })
}

const btn = document.querySelector('#downloadQR')

btn.addEventListener('click', capture)