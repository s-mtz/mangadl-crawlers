for making imgaick being able to make pdf large sizes of manga chapters for expample the berserk chapter 1 u need to make some changes to its own defult polices sudo vim /etc/ImageMagick-6/policy.xml

change the follwing policies like this

  <policy domain="resource" name="memory" value="512MiB"/>
  <policy domain="resource" name="map" value="1GiB"/>
  <policy domain="resource" name="width" value="32KP"/>
  <policy domain="resource" name="height" value="32KP"/>

  <policy domain="resource" name="area" value="512MB"/>
  <policy domain="resource" name="disk" value="2GiB"/>

  <policy domain="resource" name="time" value="9900"/>
