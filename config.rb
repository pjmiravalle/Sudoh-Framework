# Compass Config File

css_dir = 'assets/css'
sass_dir = 'assets/scss'
output_style = :compressed

# Create minified versions of each file
on_stylesheet_saved do |filename|
  if File.exists?(filename)
    dir = File.dirname(filename)
    base = File.basename(filename, ".css")
    munged_name = "#{dir}/#{base}.min.css"
    `cp #{filename} #{munged_name}`
  end
end