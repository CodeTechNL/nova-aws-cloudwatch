import LogGroupNames from './pages/LogGroupNames'
import Streams from './pages/Streams'
import Stream from './pages/ShowStream'

Nova.booting(() => {
  Nova.inertia('NovaAwsCloudwatch', LogGroupNames)
  Nova.inertia('NovaAwsCloudwatchStream', Stream)
  Nova.inertia('NovaAwsCloudwatchStreams', Streams)
})
