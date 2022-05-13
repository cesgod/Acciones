#!/usr/bin/env python3
from PIL import Image, ImageDraw, ImageFont
import datetime
import json

now = datetime.datetime.now()
currentts = "Villarrica, 14 de Julio del 2021"
#currentts = "Villarrica, " + now.strftime("%d, %B, %Y")
print (currentts)

#with open('C:\xampp\htdocs\clyfsaweb\dashboard/Acciones\assets\pdf\accdata.json', 'r', encoding="utf-8") as f:
with open('/var/www/html/dashboard/Acciones/accdata.json', 'r', encoding="utf-8") as f:
    alld = json.load(f)
lim=len(alld)
nameci=""
yp=750
xp=258
tsize=35
if (alld['group'][0]==0):
	print(alld['group'][0])
	for i in range(lim):
	    name 	= alld['name'][i].upper()
	    ci 		= alld['ci'][i]
	    acc		= alld['acciones'][i]
	    title	= alld['titulo'][i]
	    serie	= alld['serie'][i]
	    afrom	= alld['desde'][i]
	    ato		= alld['hasta'][i]
	    gs		= alld['guaranies'][i]
	    cont	= alld['tacciones'][i]
	nameci	= name + " - C.I.No. " + ci + ".-"
	fromto 	= afrom + " - " + ato
else:
	yp=710
	xp=258
	olim=len(alld['name'])
	print(olim)
	for j in range(olim):
		print("pass")
		print(alld['name'][j])
		name 	= alld['name'][j].upper()
		ci 		= alld['ci'][j]
		nameci	= nameci + name + " - C.I.No. " + ci + ".-\n\n"
		print(name, ci)
	
	#print(name, fromto)
	for x in range(1):
		acc		= alld['acciones'][x]
		title	= alld['titulo'][x]
		serie	= alld['serie'][x]
		afrom	= alld['desde'][x]
		ato		= alld['hasta'][x]
		gs		= alld['guaranies'][x]
		cont	= alld['tacciones'][x]
	fromto 	= afrom + " - " + ato
print(nameci, acc, title, serie, fromto, gs)

if (cont<=100):
	fimage = 'ACCIONESFRONT-01.png'
	bimage = 'ACCIONESBACK-01.png'
else:
	if (cont<=500 and cont>100):
		fimage = 'ACCIONESFRONT-02.png'
		bimage = 'ACCIONESBACK-02.png'
	else: 
		if (cont<=1000 and cont>500):
			fimage = 'ACCIONESFRONT-03.png'
			bimage = 'ACCIONESBACK-03.png'
		else: 
			if (cont<=5000 and cont>1000):
				fimage = 'ACCIONESFRONT-04.png'
				bimage = 'ACCIONESBACK-04.png'
			else: 
				if (cont>5000):
					fimage = 'ACCIONESFRONT-05.png'
					bimage = 'ACCIONESBACK-05.png'








fimage = '/var/www/html/dashboard/Acciones/assets/pdf/' + fimage
bimage = '/var/www/html/dashboard/Acciones/assets/pdf/' + bimage
image		= 	Image.open(fimage).convert("RGB")
image2		= 	Image.open(bimage).convert("RGB")

#acc="1111111"


fontt=ImageFont.truetype('/var/www/html/dashboard/Acciones/assets/pdf/Aldine Bold.ttf', 35)
fonttt=ImageFont.truetype('/var/www/html/dashboard/Acciones/assets/pdf/Andalus.ttf', 35)
fonttft=ImageFont.truetype('/var/www/html/dashboard/Acciones/assets/pdf/Andalus.ttf', 35)
fonttacct=ImageFont.truetype('/var/www/html/dashboard/Acciones/assets/pdf/Roboto-Condensed.ttf', 35)
fonttgs=ImageFont.truetype('/var/www/html/dashboard/Acciones/assets/pdf/Roboto-Condensed.ttf', 30)
fonttaccm=ImageFont.truetype('/var/www/html/dashboard/Acciones/assets/pdf/timesbd.ttf', 37)
fonttd=ImageFont.truetype('/var/www/html/dashboard/Acciones/assets/pdf/Roboto-Condensed.ttf', 20)

sizze = fontt.getsize(nameci)
sizzet = fonttt.getsize(title)
sizzeft = fonttft.getsize(fromto)
sizzeat = fonttacct.getsize(acc)
sizzegs = fonttgs.getsize(gs)
sizzeam = fonttgs.getsize(acc)
sizzed = fonttd.getsize(currentts)
print(sizze)
width, height = image.size
print(width, height)
if (width - sizze[0]<1 and sizze[0]>2200):
	print(sizze[0])
	textsize=sizze[0]
	print(textsize)
	xp=((textsize - width)/2)/1.4
	yp=705
	print(textsize)
	tsize 	= 27
else:
	if (width - sizze[0]<1 and sizze[0]<2200):
		print(sizze[0])
		textsize=sizze[0]
		print(textsize)
		xp=((textsize - width)/1.5)
		yp=725
		print(textsize)
		tsize 	= 27
	else:
		textsize=sizze[0]
		xp=(width-textsize)/2
		yp=762

txp=1330 + ((85-sizzet[0])/2)
ftxp=231 + ((247-sizzeft[0])/2)
atxp=60 + ((102-sizzeat[0])/2)
gsxp=1476 + ((149-sizzegs[0])/2)
amxp=790 + ((105-sizzeam[0])/2)
dxp=710 + ((244-sizzed[0])/2)
print("title size: ", sizzet)
print("from to size: ", sizzeft)
print("Acciones Top: ", sizzeat)
print("Gs: ", sizzegs)
print("Acciones Mid: ", sizzeam)
print("Date: ", sizzed)





font_type 	= 	ImageFont.truetype('/var/www/html/dashboard/Acciones/assets/pdf/Aldine Bold.ttf', tsize)
font_type_2 = 	ImageFont.truetype('/var/www/html/dashboard/Acciones/assets/pdf/Roboto-Condensed.ttf', 30)
font_type_3	= 	ImageFont.truetype('/var/www/html/dashboard/Acciones/assets/pdf/Andalus.ttf', 35)
font_type_4 = 	ImageFont.truetype('/var/www/html/dashboard/Acciones/assets/pdf/timesbd.ttf', 37)
font_type_5 = 	ImageFont.truetype('/var/www/html/dashboard/Acciones/assets/pdf/Roboto-Condensed.ttf', 35)
font_type_6 = 	ImageFont.truetype('/var/www/html/dashboard/Acciones/assets/pdf/Roboto-Condensed.ttf', 20)
draw 		= 	ImageDraw.Draw(image)



draw.text(xy=(xp,yp), text=nameci,fill=(19,64,95),font=font_type)
draw.text(xy=(atxp,60), text=acc,fill=(0,0,0),font=font_type_5)
draw.text(xy=(gsxp,110), text=gs,fill=(0,0,0),font=font_type_2)
draw.text(xy=(ftxp,250), text=fromto,fill=(0,0,0),font=font_type_3)
draw.text(xy=(1170,250), text=serie,fill=(0,0,0),font=font_type_3)
draw.text(xy=(txp,250), text=title,fill=(0,0,0),font=font_type_3)
draw.text(xy=(amxp,615), text=acc,fill=(0,0,0),font=font_type_4)
draw.text(xy=(dxp,1045), text=currentts,fill=(19,64,95),font=font_type_6)




size = 7000, 5375
imagefull = image.resize(size, Image.ANTIALIAS)
imageback = image2.resize(size, Image.ANTIALIAS)
imageb = [imageback]
#draw.text(xy=(100,100), text="Some text II",fill=(255,69,0),font=font_type_2)
#image.show()
imagefull.save("/var/www/html/dashboard/Acciones/assets/pdf/titulopdf.PDF", save_all=True, append_images=imageb)
