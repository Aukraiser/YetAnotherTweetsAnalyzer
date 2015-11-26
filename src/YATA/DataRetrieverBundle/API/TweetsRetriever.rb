#$:.unshift(File.expand_path("../../API/twitter/lib"))
require 'twitter'
require 'json'

# Create client object
client = Twitter::REST::Client.new do |config|
  config.consumer_key        = "orVdAPiraBVOtgkSYCcUJQDjG"
  config.consumer_secret     = "5Fio3wBlIQ3zwR6aqckxWjlTNnwXjHaOw3LOxOugrPjcQVhjCA"
  config.access_token        = "1460769499-A0JKXMVFJ8HBopZRLCgPZqY4xisUmxv4XPHucAV"
  config.access_token_secret = "LDNfYScunuCjgtfDqAsDJjjYqnv8IGty5zdtjvWMCKwpC"
end

client.search("to: test", result_type: "recent").take(3).each do |tweet|
  #puts tweet.text
  puts "blabla"
end
